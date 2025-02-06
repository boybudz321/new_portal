<?php

namespace App\Filament\Resources\SeafarerResource\Pages;

use Carbon\Carbon;
use App\Models\User;
use Filament\Actions;
use App\Models\Seafarer;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Forms\Components\FileUpload;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\SeafarerResource;

class ListSeafarers extends ListRecords
{
    protected static string $resource = SeafarerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\Action::make('importJson')
                ->label('Import JSON')
                ->action(function (array $data) {
                    $this->handleJsonImport($data);
                })
                ->modalHeading('Import Seafarer JSON Data')
                ->modalWidth('lg')
                ->form([
                    FileUpload::make('json_file')
                        ->label('JSON File')
                        ->multiple()
                        ->acceptedFileTypes(['application/json', 'text/json', 'text/plain'])
                        ->disk('private')
                        ->directory('livewire-tmp')
                        ->required()
                        ->maxSize(5120) // 5MB
                        ->helperText('Upload a JSON file containing seafarer data.')
                        ->previewable(true)
                        ->openable(true),
                ]),
        ];
    }

    protected function handleJsonImport(array $data)
    {
        try {
            $files = $data['json_file'];  // This will now be an array of file paths.

            DB::beginTransaction();

            foreach ($files as $filePath) {
                $filePath = str_replace('private/', '', $filePath);  // Clean the path if needed.

                Log::info('Attempting to import file', [
                    'path' => $filePath,
                    'exists' => Storage::disk('private')->exists($filePath),
                    'full_path' => Storage::disk('private')->path($filePath)
                ]);

                if (!Storage::disk('private')->exists($filePath)) {
                    throw new \Exception("File not found: $filePath");
                }

                $jsonContent = Storage::disk('private')->get($filePath);

                $parsedData = json_decode($jsonContent, true);

                if (json_last_error() !== JSON_ERROR_NONE) {
                    throw new \Exception('Invalid JSON format: ' . json_last_error_msg());
                }

                // Save each parsed JSON file's data to the database.
                $this->saveImportedData($parsedData);
            }

            DB::commit();

            Notification::make()
                ->title('Data Imported Successfully')
                ->success()
                ->send();
        } catch (\Exception $e) {
            DB::rollBack();

            Notification::make()
                ->title('Import Failed')
                ->body($e->getMessage())
                ->danger()
                ->send();

            Log::error('Seafarer Import Error: ' . $e->getMessage(), [
                'file' => $filePath ?? 'No file path',
                'trace' => $e->getTraceAsString()
            ]);
        } finally {
            // Ensure all files are deleted, regardless of success or failure.
            foreach ($files as $file) {
                $file = str_replace('private/', '', $file);  // Clean the path if needed.
                if (Storage::disk('private')->exists($file)) {
                    Storage::disk('private')->delete($file);
                    Log::info("File deleted: $file");
                }
            }
        }
    }


    protected function saveImportedData(array $data)
    {

        // Create the user first if email exists
        $user = null;
        if (!empty($data['seaman_data']['primary_email'])) {
            $user = $this->createSeafarerUser($data['seaman_data']);
        }

        // Prepare seafarer data with user_id
        $seafarerData = $this->prepareSeafarerData($data['seaman_data']);
        if ($user) {
            $seafarerData['user_id'] = $user->id;
        }

        // 1. Create the main seafarer entry
        $seafarer = Seafarer::updateOrCreate(
            [
                'id' => $seafarerData['id'] ?? null,
                'primary_email' => $seafarerData['primary_email'] ?? null
            ],
            $seafarerData
        );

        // 2. Create addresses
        if (!empty($data['address_list'])) {
            $this->createAddresses($seafarer, $data['address_list']);
        }

        // 3. Create relatives
        if (!empty($data['relative_list'])) {
            $this->createRelatives($seafarer, $data['relative_list']);
        }

        // 4. Create bank accounts
        if (!empty($data['bank_list'])) {
            $this->createBankAccounts($seafarer, $data['bank_list']);
        }

        // 5. Create certifications
        if (!empty($data['cert_list'])) {
            $this->createCertifications($seafarer, $data['cert_list']);
        }

        // 6. Create employment history
        if (!empty($data['employment_list'])) {
            $this->createEmploymentHistory($seafarer, $data['employment_list']);
        }

        // 7. Create uniform data
        if (!empty($data['uniform_data'])) {
            $this->createUniformData($seafarer, $data['uniform_data']);
        }

        return $seafarer;
    }

    protected function createSeafarerUser(array $seafarerData): User
    {
        // Format birthdate into MMDDYY
        $birthdate = Carbon::parse($seafarerData['pp_dob'])->format('mdy');

        // Create username: First letter of first name + Surname + MMDDYY
        $username = strtoupper(
            substr($seafarerData['name'], 0, 1) .
                $seafarerData['surname'] .
                $birthdate
        );

        // Remove any spaces from username
        $username = str_replace(' ', '', $username);

        // Create or update the user
        $user = User::updateOrCreate(
            ['email' => $seafarerData['primary_email']],
            [
                'name' => trim($seafarerData['name'] . ' ' . $seafarerData['middle_name'] . ' ' . $seafarerData['surname']),
               // 'username' => $username,
                'password' => bcrypt($birthdate), // Use birthdate as password
            ]
        );

        $tenant = Filament::getTenant();
        $tenant->members()->attach($user);

        // Assign the default role
        // if (!$user->hasRole('seafarer')) {
        //     $user->assignRole('seafarer');
        // }

        return $user;
    }

    private function prepareSeafarerData(array $data): array
    {

        // Set id explicitly if provided, otherwise let auto-increment handle it
        $preparedData = [
            'id' => $data['id'] ?? null,  // This will use auto-increment if null
            'manual_id' => $this->formatNullableValue($data['manual_id'], 'string'),
            'old_id' => $this->formatNullableValue($data['old_id'], 'string'),

            // Dates
            'registration_date' => $this->formatDate($data['registration_date']),
            'online_set_date' => $this->formatDate($data['online_set_date']),
            'online_date' => $this->formatDate($data['online_date']),
            'online_datetime' => $this->formatDate($data['online_datetime']),
            'client_date' => $this->formatDate($data['client_date']),
            'pp_dob' => $this->formatDate($data['pp_dob']),
            'curr_location_date' => $this->formatDate($data['curr_location_date']),
            'available_from' => $this->formatDate($data['available_from']),
            'available_to' => $this->formatDate($data['available_to']),
            'last_employment_off_date' => $this->formatDate($data['last_employment_off_date']),

            // Boolean fields
            'not_sms_event' => $this->formatBoolean($data['not_sms_event']),
            'not_email_event' => $this->formatBoolean($data['not_email_event']),
            'is_unsubscribe' => $this->formatBoolean($data['is_unsubscribe']),

            // Integer fields
            'rank_id' => intval($data['rank_id'] ?? 0),
            'vessel_id' => intval($data['vessel_id'] ?? 0),
            'photo_id' => intval($data['photo_id'] ?? 0),
            'country_id' => intval($data['country_id'] ?? 0),
            'citizenship_id' => intval($data['citizenship_id'] ?? 0),
            'taxation_country_id' => intval($data['taxation_country_id'] ?? 0),
            'primary_office_id' => intval($data['primary_office_id'] ?? 0),
            'primary_bank_id' => intval($data['primary_bank_id'] ?? 0),
            'primary_address_id' => intval($data['primary_address_id'] ?? 0),
            'primary_relative_id' => intval($data['primary_relative_id'] ?? 0),
            'primary_contact_id' => intval($data['primary_contact_id'] ?? 0),
            'seniority_id' => intval($data['seniority_id'] ?? 0),
            'seniority_days' => intval($data['seniority_days'] ?? 0),
            'age' => intval($data['age'] ?? 0),
            'pp_country_id' => intval($data['pp_country_id'] ?? 0),
            'marital_id' => intval($data['marital_id'] ?? 0),

            // Decimal fields
            'seniority_months' => $this->formatNullableValue($data['seniority_months'], 'numeric'),

            // String fields
            'status' => $this->formatNullableValue($data['status']),
            'surname' => $this->formatNullableValue($data['surname']),
            'name' => $this->formatNullableValue($data['name']),
            'full_name' => $this->formatNullableValue($data['full_name']),
            'middle_name' => $this->formatNullableValue($data['middle_name']),
            'calling_name' => $this->formatNullableValue($data['calling_name']),
            'national_full_name' => $this->formatNullableValue($data['national_full_name']),
            'child_cnt' => $this->formatNullableValue($data['child_cnt']),
            'fast_note' => $this->formatNullableValue($data['fast_note']),
            'fast_note2' => $this->formatNullableValue($data['fast_note2']),
            'pp_pob' => $this->formatNullableValue($data['pp_pob']),
            'pp_id_code' => $this->formatNullableValue($data['pp_id_code']),
            '_check_sum' => $this->formatNullableValue($data['_check_sum']),
            'primary_email' => $this->formatNullableValue($data['primary_email']),
            'primary_address' => $this->formatNullableValue($data['primary_address']),
            'primary_postal_index' => $this->formatNullableValue($data['primary_postal_index']),
            'primary_mobile' => $this->formatNullableValue($data['primary_mobile']),
            'primary_airport' => $this->formatNullableValue($data['primary_airport']),
            'sex' => $this->formatNullableValue($data['sex']),
            'acc_no' => $this->formatNullableValue($data['acc_no']),
            'curr_location' => $this->formatNullableValue($data['curr_location']),
            'marital_status' => $this->formatNullableValue($data['marital_status']),
            '_r_id' => $this->formatNullableValue($data['_r_id']),
            'rank_name' => $this->formatNullableValue($data['rank_name']),
            'rank_short_name' => $this->formatNullableValue($data['rank_short_name']),
            'rank_long_name' => $this->formatNullableValue($data['rank_long_name']),
            'rank_export_id' => $this->formatNullableValue($data['rank_export_id']),
            'status_name' => $this->formatNullableValue($data['status_name']),
            'status_export_id' => $this->formatNullableValue($data['status_export_id']),
            'country_code' => $this->formatNullableValue($data['country_code']),
            'pp_country_code' => $this->formatNullableValue($data['pp_country_code']),
            'taxation_country_code' => $this->formatNullableValue($data['taxation_country_code']),
            'pp_country_name' => $this->formatNullableValue($data['pp_country_name']),
            'taxation_country_name' => $this->formatNullableValue($data['taxation_country_name']),
            'citizenship_name' => $this->formatNullableValue($data['citizenship_name']),
            'office_name' => $this->formatNullableValue($data['office_name']),
            'office_registered_name' => $this->formatNullableValue($data['office_registered_name']),
            'country_name' => $this->formatNullableValue($data['country_name']),
            'onboard_emp_id' => $this->formatNullableValue($data['onboard_emp_id']),
            'joining_emp_id' => $this->formatNullableValue($data['joining_emp_id']),
            'planned_emp_id' => $this->formatNullableValue($data['planned_emp_id']),
            'last_employment_state' => $this->formatNullableValue($data['last_employment_state']),
            'last_vessel_name' => $this->formatNullableValue($data['last_vessel_name']),
            'last_vessel_id' => $this->formatNullableValue($data['last_vessel_id']),
            'last_client_name' => $this->formatNullableValue($data['last_client_name']),
            'available' => $this->formatNullableValue($data['available']),
            'vessel_name' => $this->formatNullableValue($data['vessel_name']),
            'last_employment_id' => $this->formatNullableValue($data['last_employment_id']),
            'last_contract_id' => $this->formatNullableValue($data['last_contract_id']),
            'last_deployment_id' => $this->formatNullableValue($data['last_deployment_id']),
            'taxation_id_code' => $this->formatNullableValue($data['taxation_id_code']),
        ];

        // Remove any null ID if it was set
        if (is_null($preparedData['id'])) {
            unset($preparedData['id']);
        }

        return $preparedData;
    }

    private function createAddresses(Seafarer $seafarer, array $addresses): void
    {
        foreach ($addresses as $address) {
            $address['referencing_id'] = $seafarer->id;
            $seafarer->addresses()->updateOrCreate($this->prepareDateFields($address));
        }
    }

    private function createRelatives(Seafarer $seafarer, array $relatives): void
    {
        foreach ($relatives as $relative) {
            $relative['seaman_id'] = $seafarer->id;
            $seafarer->relatives()->updateOrCreate($this->prepareDateFields($relative, ['birth_date']));
        }
    }

    private function createBankAccounts(Seafarer $seafarer, array $accounts): void
    {
        foreach ($accounts as $account) {
            $account['seaman_id'] = $seafarer->id;
            $seafarer->bankAccounts()->updateOrCreate($account);
        }
    }

    private function createCertifications(Seafarer $seafarer, array $certifications): void
    {
        foreach ($certifications as $cert) {
            $cert['seaman_id'] = $seafarer->id;
            $seafarer->certifications()->updateOrCreate($this->prepareDateFields($cert, [
                'to_date',
                'from_date'
            ]));
        }
    }

    private function createEmploymentHistory(Seafarer $seafarer, array $employments): void
    {
        foreach ($employments as $employment) {
            $formattedEmployment = [
                // Required ID and foreign keys
                'seaman_id' => $seafarer->id,
                'contract_id' => $this->formatNullableValue($employment['contract_id'], 'integer'),
                'order_id' => intval($employment['order_id'] ?? 0),
                'vessel_id' => intval($employment['vessel_id'] ?? 0),
                'rank_id' => intval($employment['rank_id'] ?? 0),
                'template_id' => intval($employment['template_id'] ?? 0),
                'relief_id' => intval($employment['relief_id'] ?? 0),
                'state' => intval($employment['state'] ?? 0),
                'invoice_office_id' => $this->formatNullableValue($employment['invoice_office_id'], 'integer'),
                'payroll_office_id' => $this->formatNullableValue($employment['payroll_office_id'], 'integer'),
                'contract_type' => $this->formatNullableValue($employment['contract_type']),

                // Dates
                'eoc_date_ordered' => $this->formatDate($employment['eoc_date_ordered']),
                'est_on_date' => $this->formatDate($employment['est_on_date']),
                'boc_date' => $this->formatDate($employment['boc_date']),
                'on_date' => $this->formatDate($employment['on_date']),
                'est_off_date' => $this->formatDate($employment['est_off_date']),
                'off_date' => $this->formatDate($employment['off_date']),
                'eoc_date' => $this->formatDate($employment['eoc_date']),
                'cert_check_date' => $this->formatDate($employment['cert_check_date']),

                // Boolean fields
                'est_off_auto' => $this->formatBoolean($employment['est_off_auto']),
                'off_request' => $this->formatBoolean($employment['off_request']),
                'tax_facility' => $this->formatBoolean($employment['tax_facility']),
                'is_incomplete' => $this->formatBoolean($employment['is_incomplete']),

                // Integer fields
                'on_days' => intval($employment['on_days'] ?? 0),
                'on_months' => intval($employment['on_months'] ?? 0),
                'service_days' => intval($employment['service_days'] ?? 0),
                'contract_days' => intval($employment['contract_days'] ?? 0),
                'cert_ok' => intval($employment['cert_ok'] ?? 0),
                'cert_expired' => intval($employment['cert_expired'] ?? 0),
                'cert_expiring' => intval($employment['cert_expiring'] ?? 0),
                'cert_missing' => intval($employment['cert_missing'] ?? 0),

                // String fields
                'on_port' => $this->formatNullableValue($employment['on_port']),
                'on_country' => $this->formatNullableValue($employment['on_country']),
                'on_country_name' => $this->formatNullableValue($employment['on_country_name']),
                'off_country_name' => $this->formatNullableValue($employment['off_country_name']),
                'location_country_name' => $this->formatNullableValue($employment['location_country_name']),
                'on_route' => $this->formatNullableValue($employment['on_route']),
                'off_port' => $this->formatNullableValue($employment['off_port']),
                'off_country' => $this->formatNullableValue($employment['off_country']),
                'off_route' => $this->formatNullableValue($employment['off_route']),
                'relief_name' => $this->formatNullableValue($employment['relief_name']),
                'seaman_full_name' => $this->formatNullableValue($employment['seaman_full_name']),
                'seaman_name' => $this->formatNullableValue($employment['seaman_name']),
                'seaman_surname' => $this->formatNullableValue($employment['seaman_surname']),
                'seaman_country' => $this->formatNullableValue($employment['seaman_country']),
                'seaman_country_name' => $this->formatNullableValue($employment['seaman_country_name']),
                'rank_name' => $this->formatNullableValue($employment['rank_name']),
                'rank_long_name' => $this->formatNullableValue($employment['rank_long_name']),
                'rank_export_id' => $this->formatNullableValue($employment['rank_export_id']),
                'vessel_name' => $this->formatNullableValue($employment['vessel_name']),
                'vessel_country_code' => $this->formatNullableValue($employment['vessel_country_code']),
                'vessel_type_id' => $this->formatNullableValue($employment['vessel_type_id']),
                'vessel_engine_model' => $this->formatNullableValue($employment['vessel_engine_model']),
                'vessel_imo_no' => $this->formatNullableValue($employment['vessel_imo_no']),

                // Numeric fields that can be null
                'vessel_dwt' => $this->formatNullableValue($employment['vessel_dwt'], 'numeric'),
                'vessel_gt' => $this->formatNullableValue($employment['vessel_gt'], 'numeric'),
                'vessel_length' => $this->formatNullableValue($employment['vessel_length'], 'numeric'),
                'vessel_engine_power' => $this->formatNullableValue($employment['vessel_engine_power'], 'numeric'),

                // The rest of the fields
                'vessel_engine_id' => intval($employment['vessel_engine_id'] ?? 0),
                'vessel_dp_type_id' => intval($employment['vessel_dp_type_id'] ?? 0),
                'vessel_dp_manufacturer_id' => intval($employment['vessel_dp_manufacturer_id'] ?? 0),
                'vessel_builder_id' => intval($employment['vessel_builder_id'] ?? 0),
                'vessel_year' => $this->formatNullableValue($employment['vessel_year']),
                'vessel_pump' => $this->formatNullableValue($employment['vessel_pump']),
                'vessel_gear' => $this->formatNullableValue($employment['vessel_gear']),
                'vessel_pump_name' => $this->formatNullableValue($employment['vessel_pump_name']),
                'vessel_gear_name' => $this->formatNullableValue($employment['vessel_gear_name']),
                'vessel_type_name' => $this->formatNullableValue($employment['vessel_type_name']),
                'vessel_type_export_id' => $this->formatNullableValue($employment['vessel_type_export_id']),
                'vessel_engine_name' => $this->formatNullableValue($employment['vessel_engine_name']),
                'vessel_engine_export_id' => $this->formatNullableValue($employment['vessel_engine_export_id']),
                'vessel_year_built' => $this->formatNullableValue($employment['vessel_year_built']),
                'vessel_grt' => $this->formatNullableValue($employment['vessel_grt']),

                // Additional fields
                'agent_name' => $this->formatNullableValue($employment['agent_name']),
                'owner_name' => $this->formatNullableValue($employment['owner_name']),
                'project_id' => $this->formatNullableValue($employment['project_id']),
                'project_name' => $this->formatNullableValue($employment['project_name']),
                'vessel_operation_id' => $this->formatNullableValue($employment['vessel_operation_id']),
                'client_name' => $this->formatNullableValue($employment['client_name']),
                'client_id' => $this->formatNullableValue($employment['client_id']),
                'vessel_client_id' => $this->formatNullableValue($employment['vessel_client_id']),
                'contract_employer' => $this->formatNullableValue($employment['contract_employer']),
                'vessel_employer' => $this->formatNullableValue($employment['vessel_employer']),
                'vessel_manager' => $this->formatNullableValue($employment['vessel_manager']),
                'off_reason_id' => intval($employment['off_reason_id'] ?? 0),
                'off_reason_name' => $this->formatNullableValue($employment['off_reason_name']),
                'off_reason_color' => $this->formatNullableValue($employment['off_reason_color']),
                'cpr_status' => intval($employment['cpr_status'] ?? 0),
                'cpr_signers' => $this->formatNullableValue($employment['cpr_signers']),
                'cpr_template_id' => intval($employment['cpr_template_id'] ?? 0),
                'currency_code' => $this->formatNullableValue($employment['currency_code']),
                '_check_sum' => $this->formatNullableValue($employment['_check_sum']),
                '_total' => $this->formatNullableValue($employment['_total'], 'numeric'),
                '_total_formated' => $this->formatNullableValue($employment['_total_formated']),
                'payroll_office_name' => $this->formatNullableValue($employment['payroll_office_name']),
                'invoice_office_name' => $this->formatNullableValue($employment['invoice_office_name']),
                'employment_vessel_name' => $this->formatNullableValue($employment['employment_vessel_name']),
            ];

            $seafarer->employmentHistory()->updateOrCreate($formattedEmployment);
        }
    }

    private function formatBoolean($value): int
    {
        if (is_null($value) || $value === '') {
            return 0;
        }
        return $value ? 1 : 0;
    }

    private function createUniformData(Seafarer $seafarer, array $uniformData): void
    {
        $formattedUniformData = [
            'seaman_id' => $seafarer->id,

            // Numeric fields
            'height' => $this->formatNullableValue($uniformData['height'], 'numeric'),
            'chest' => $this->formatNullableValue($uniformData['chest'], 'numeric'),
            'weight' => $this->formatNullableValue($uniformData['weight'], 'numeric'),
            'bmi' => $this->formatNullableValue($uniformData['bmi'], 'numeric'),

            // String fields
            'boilersuit' => $this->formatNullableValue($uniformData['boilersuit']),
            'boots' => $this->formatNullableValue($uniformData['boots']),
            'sweater' => $this->formatNullableValue($uniformData['sweater']),
            'trousers' => $this->formatNullableValue($uniformData['trousers']),
            'pilot_shirt' => $this->formatNullableValue($uniformData['pilot_shirt']),
            'eyes_color' => $this->formatNullableValue($uniformData['eyes_color']),
            'blood_rhesus' => $this->formatNullableValue($uniformData['blood_rhesus']),
            'blood_type' => $this->formatNullableValue($uniformData['blood_type']),
            'religion_name' => $this->formatNullableValue($uniformData['religion_name']),
            'measure_type' => $this->formatNullableValue($uniformData['measure_type']),
            'insurance_name' => $this->formatNullableValue($uniformData['insurance_name']),
            'membership_no' => $this->formatNullableValue($uniformData['membership_no']),
            'medical_plan' => $this->formatNullableValue($uniformData['medical_plan']),
            'contact_no' => $this->formatNullableValue($uniformData['contact_no']),
            'chronic_illness' => $this->formatNullableValue($uniformData['chronic_illness']),
            'allergies' => $this->formatNullableValue($uniformData['allergies']),
            'medication' => $this->formatNullableValue($uniformData['medication']),
            'hair_color' => $this->formatNullableValue($uniformData['hair_color']),

            // Boolean fields
            'main_member' => $this->formatBoolean($uniformData['main_member']),
            'smoking' => $this->formatBoolean($uniformData['smoking']),
            'drinking' => $this->formatBoolean($uniformData['drinking']),
            'tattoos' => $this->formatBoolean($uniformData['tattoos']),

            // Integer fields
            'religion_id' => intval($uniformData['religion_id'] ?? 0),

            // Date fields
            'insurance_from_date' => $this->formatDate($uniformData['insurance_from_date']),
            'insurance_to_date' => $this->formatDate($uniformData['insurance_to_date']),
        ];

        $seafarer->uniformData()->updateOrCreate($formattedUniformData);
    }

    private function formatDate($date)
    {
        if (empty($date)) {
            return null;
        }

        try {
            if (strpos($date, '.') !== false) {
                return Carbon::createFromFormat('d.m.Y', $date)->format('Y-m-d');
            } elseif (strpos($date, '-') !== false) {
                return Carbon::parse($date)->format('Y-m-d');
            }
            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    private function formatNullableValue($value, $type = 'string')
    {
        if (is_null($value) || $value === '') {
            return $type === 'string' ? '' : null;
        }

        switch ($type) {
            case 'integer':
                return intval($value);
            case 'numeric':
                return is_numeric($value) ? $value : null;
            case 'boolean':
                return $this->formatBoolean($value);
            default:
                return $value;
        }
    }

    private function prepareDateFields(array $data, array $dateFields = []): array
    {
        foreach ($dateFields as $field) {
            if (!empty($data[$field])) {
                try {
                    $data[$field] = Carbon::createFromFormat('d.m.Y', $data[$field])->format('Y-m-d');
                } catch (\Exception $e) {
                    $data[$field] = null;
                }
            }
        }
        return $data;
    }
}
