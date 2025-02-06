<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmploymentHistoryResource\Pages;
use App\Models\EmploymentHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class EmploymentHistoryResource extends Resource
{
    protected static ?string $model = EmploymentHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-briefcase';

    protected static ?string $navigationGroup = 'Seafarer Management';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('contract_id')
                    ->label('Contract ID')
                    ->placeholder('Enter contract ID'),

                Forms\Components\TextInput::make('order_id')
                    ->label('Order ID')
                    ->placeholder('Enter order ID'),

                Forms\Components\TextInput::make('vessel_id')
                    ->label('Vessel ID')
                    ->placeholder('Enter vessel ID'),

                Forms\Components\TextInput::make('seaman_id')
                    ->label('Seaman ID')
                    ->required()
                    ->placeholder('Enter seaman ID'),

                Forms\Components\TextInput::make('rank_id')
                    ->label('Rank ID')
                    ->placeholder('Enter rank ID'),

                Forms\Components\TextInput::make('template_id')
                    ->label('Template ID')
                    ->placeholder('Enter template ID'),

                Forms\Components\TextInput::make('relief_id')
                    ->label('Relief ID')
                    ->placeholder('Enter relief ID'),

                Forms\Components\TextInput::make('state')
                    ->label('State')
                    ->placeholder('Enter state'),

                Forms\Components\TextInput::make('invoice_office_id')
                    ->label('Invoice Office ID')
                    ->placeholder('Enter invoice office ID'),

                Forms\Components\TextInput::make('payroll_office_id')
                    ->label('Payroll Office ID')
                    ->placeholder('Enter payroll office ID'),

                Forms\Components\TextInput::make('contract_type')
                    ->label('Contract Type')
                    ->placeholder('Enter contract type'),

                Forms\Components\DatePicker::make('eoc_date_ordered')
                    ->label('EOC Date Ordered'),

                Forms\Components\DatePicker::make('est_on_date')
                    ->label('Estimated On Date'),

                Forms\Components\DatePicker::make('boc_date')
                    ->label('BOC Date'),

                Forms\Components\DatePicker::make('on_date')
                    ->label('On Date')
                    ->required(),

                Forms\Components\Toggle::make('est_off_auto')
                    ->label('Est Off Auto'),

                Forms\Components\DatePicker::make('est_off_date')
                    ->label('Estimated Off Date'),

                Forms\Components\DatePicker::make('off_date')
                    ->label('Off Date'),

                Forms\Components\DatePicker::make('eoc_date')
                    ->label('EOC Date'),

                Forms\Components\TextInput::make('on_days')
                    ->label('On Days')
                    ->placeholder('Enter on days'),

                Forms\Components\TextInput::make('on_months')
                    ->label('On Months')
                    ->placeholder('Enter on months'),

                Forms\Components\TextInput::make('service_days')
                    ->label('Service Days')
                    ->placeholder('Enter service days'),

                Forms\Components\TextInput::make('contract_days')
                    ->label('Contract Days')
                    ->placeholder('Enter contract days'),

                Forms\Components\Toggle::make('is_incomplete')
                    ->label('Is Incomplete'),

                Forms\Components\TextInput::make('on_port')
                    ->label('On Port')
                    ->placeholder('Enter on port'),

                Forms\Components\TextInput::make('on_country')
                    ->label('On Country')
                    ->placeholder('Enter on country'),

                Forms\Components\TextInput::make('on_country_name')
                    ->label('On Country Name')
                    ->placeholder('Enter on country name'),

                Forms\Components\TextInput::make('off_country_name')
                    ->label('Off Country Name')
                    ->placeholder('Enter off country name'),

                Forms\Components\TextInput::make('location_country_name')
                    ->label('Location Country Name')
                    ->placeholder('Enter location country name'),

                Forms\Components\TextInput::make('on_route')
                    ->label('On Route')
                    ->placeholder('Enter on route'),

                Forms\Components\TextInput::make('off_port')
                    ->label('Off Port')
                    ->placeholder('Enter off port'),

                Forms\Components\TextInput::make('off_country')
                    ->label('Off Country')
                    ->placeholder('Enter off country'),

                Forms\Components\TextInput::make('off_route')
                    ->label('Off Route')
                    ->placeholder('Enter off route'),

                Forms\Components\TextInput::make('off_reason_id')
                    ->label('Off Reason ID')
                    ->placeholder('Enter off reason ID'),

                Forms\Components\Toggle::make('off_request')
                    ->label('Off Request'),

                Forms\Components\TextInput::make('cpr_status')
                    ->label('CPR Status')
                    ->placeholder('Enter CPR status'),

                Forms\Components\TextInput::make('cpr_signers')
                    ->label('CPR Signers')
                    ->placeholder('Enter CPR signers'),

                Forms\Components\Toggle::make('tax_facility')
                    ->label('Tax Facility'),

                Forms\Components\TextInput::make('_check_sum')
                    ->label('Check Sum')
                    ->placeholder('Enter check sum'),

                Forms\Components\TextInput::make('_total')
                    ->label('Total')
                    ->placeholder('Enter total'),

                Forms\Components\TextInput::make('_total_formated')
                    ->label('Total Formatted')
                    ->placeholder('Enter formatted total'),

                Forms\Components\DatePicker::make('cert_check_date')
                    ->label('Cert Check Date'),

                Forms\Components\TextInput::make('cert_ok')
                    ->label('Cert OK')
                    ->placeholder('Enter cert ok count'),

                Forms\Components\TextInput::make('cert_expired')
                    ->label('Cert Expired')
                    ->placeholder('Enter expired cert count'),

                Forms\Components\TextInput::make('cert_expiring')
                    ->label('Cert Expiring')
                    ->placeholder('Enter expiring cert count'),

                Forms\Components\TextInput::make('cert_missing')
                    ->label('Cert Missing')
                    ->placeholder('Enter missing cert count'),

                Forms\Components\TextInput::make('payroll_office_name')
                    ->label('Payroll Office Name')
                    ->placeholder('Enter payroll office name'),

                Forms\Components\TextInput::make('invoice_office_name')
                    ->label('Invoice Office Name')
                    ->placeholder('Enter invoice office name'),

                Forms\Components\TextInput::make('relief_name')
                    ->label('Relief Name')
                    ->placeholder('Enter relief name'),

                Forms\Components\TextInput::make('seaman_full_name')
                    ->label('Seaman Full Name')
                    ->placeholder('Enter seaman full name'),

                Forms\Components\TextInput::make('seaman_name')
                    ->label('Seaman Name')
                    ->placeholder('Enter seaman name'),

                Forms\Components\TextInput::make('seaman_surname')
                    ->label('Seaman Surname')
                    ->placeholder('Enter seaman surname'),

                Forms\Components\TextInput::make('seaman_country')
                    ->label('Seaman Country')
                    ->placeholder('Enter seaman country'),

                Forms\Components\TextInput::make('seaman_country_name')
                    ->label('Seaman Country Name')
                    ->placeholder('Enter seaman country name'),

                Forms\Components\DatePicker::make('pp_dob')
                    ->label('Date of Birth')
                    ->placeholder('Enter date of birth'),

                Forms\Components\TextInput::make('rank_name')
                    ->label('Rank Name')
                    ->required()
                    ->placeholder('Enter rank name'),

                Forms\Components\TextInput::make('rank_long_name')
                    ->label('Rank Long Name')
                    ->placeholder('Enter rank long name'),

                Forms\Components\TextInput::make('rank_export_id')
                    ->label('Rank Export ID')
                    ->placeholder('Enter rank export id'),

                Forms\Components\TextInput::make('vessel_name')
                    ->label('Vessel Name')
                    ->required()
                    ->placeholder('Enter vessel name'),

                Forms\Components\TextInput::make('vessel_country_code')
                    ->label('Vessel Country Code')
                    ->placeholder('Enter vessel country code'),

                Forms\Components\TextInput::make('vessel_type_id')
                    ->label('Vessel Type'),

                Forms\Components\TextInput::make('vessel_dwt')
                    ->label('Vessel DWT')
                    ->placeholder('Enter vessel DWT'),

                Forms\Components\TextInput::make('vessel_gt')
                    ->label('Vessel GT')
                    ->placeholder('Enter vessel GT'),

                Forms\Components\TextInput::make('vessel_engine_id')
                    ->label('Vessel Engine')
                    ->placeholder('Enter vessel engine'),

                Forms\Components\TextInput::make('vessel_dp_type_id')
                    ->label('DP Type')
                    ->placeholder('Enter DP type'),

                Forms\Components\TextInput::make('vessel_dp_manufacturer_id')
                    ->label('DP Manufacturer')
                    ->placeholder('Enter DP manufacturer'),

                Forms\Components\TextInput::make('vessel_engine_model')
                    ->label('Vessel Engine Model')
                    ->placeholder('Enter vessel engine model'),

                Forms\Components\TextInput::make('vessel_imo_no')
                    ->label('Vessel IMO Number')
                    ->placeholder('Enter vessel IMO number'),

                Forms\Components\TextInput::make('vessel_builder_id')
                    ->label('Vessel Builder')
                    ->placeholder('Enter vessel builder'),

                Forms\Components\TextInput::make('vessel_length')
                    ->label('Vessel Length (m)')
                    ->placeholder('Enter vessel length'),

                Forms\Components\TextInput::make('vessel_engine_power')
                    ->label('Vessel Engine Power (kW)')
                    ->placeholder('Enter vessel engine power'),

                Forms\Components\TextInput::make('vessel_year')
                    ->label('Vessel Year Built')
                    ->placeholder('Enter vessel year built'),

                Forms\Components\TextInput::make('agent_name')
                    ->label('Agent Name')
                    ->placeholder('Enter agent name'),

                Forms\Components\TextInput::make('owner_name')
                    ->label('Owner Name')
                    ->placeholder('Enter owner name'),

                Forms\Components\TextInput::make('project_id')
                    ->label('Project')
                    ->placeholder('Enter project'),

                Forms\Components\TextInput::make('project_name')
                    ->label('Project Name')
                    ->placeholder('Enter project name'),

                Forms\Components\TextInput::make('vessel_operation_id')
                    ->label('Vessel Operation')
                    ->placeholder('Enter vessel operation'),

                Forms\Components\TextInput::make('location_port')
                    ->label('Port')
                    ->placeholder('Enter port'),

                Forms\Components\TextInput::make('location_country')
                    ->label('Country')
                    ->placeholder('Enter country'),

                Forms\Components\TextInput::make('vessel_pump')
                    ->label('Vessel Pump')
                    ->placeholder('Enter vessel pump'),

                Forms\Components\TextInput::make('vessel_gear')
                    ->label('Vessel Gear')
                    ->placeholder('Enter vessel gear'),

                Forms\Components\TextInput::make('vessel_pump_name')
                    ->label('Pump Name')
                    ->placeholder('Enter pump name'),

                Forms\Components\TextInput::make('vessel_gear_name')
                    ->label('Gear Name')
                    ->placeholder('Enter gear name'),

                Forms\Components\TextInput::make('template_name')
                    ->label('Template Name')
                    ->placeholder('Enter template name'),

                Forms\Components\FileUpload::make('template_include_file')
                    ->label('Template Include File')
                    ->placeholder('Enter template include file'),

                Forms\Components\TextInput::make('dp_type_name')
                    ->label('DP Type Name')
                    ->placeholder('Enter DP type name'),

                Forms\Components\TextInput::make('dp_manufacturer_name')
                    ->label('DP Manufacturer Name')
                    ->placeholder('Enter DP manufacturer name'),

                Forms\Components\TextInput::make('off_reason_name')
                    ->label('Off Reason Name')
                    ->placeholder('Enter off reason name'),

                Forms\Components\ColorPicker::make('off_reason_color')
                    ->label('Off Reason Color')
                    ->placeholder('Enter off reason color'),

                Forms\Components\TextInput::make('builder_name')
                    ->label('Builder Name')
                    ->placeholder('Enter builder name'),

                Forms\Components\TextInput::make('client_name')
                    ->label('Client Name')
                    ->placeholder('Enter client name'),

                Forms\Components\TextInput::make('contract_employer')
                    ->label('Contract Employer')
                    ->placeholder('Enter contract employer'),

                Forms\Components\TextInput::make('vessel_employer')
                    ->label('Vessel Employer')
                    ->placeholder('Enter vessel employer'),

                Forms\Components\TextInput::make('vessel_manager')
                    ->label('Vessel Manager')
                    ->placeholder('Enter vessel manager'),

                Forms\Components\TextInput::make('currency_code')
                    ->label('Currency Code'),

                Forms\Components\TextInput::make('vessel_type_name')
                    ->label('Vessel Type Name')
                    ->placeholder('Enter vessel type name'),

                Forms\Components\TextInput::make('vessel_type_export_id')
                    ->label('Vessel Type Export ID')
                    ->placeholder('Enter vessel type export ID'),

                Forms\Components\TextInput::make('vessel_engine_name')
                    ->label('Vessel Engine Name')
                    ->placeholder('Enter vessel engine name'),

                Forms\Components\TextInput::make('vessel_engine_export_id')
                    ->label('Vessel Engine Export ID')
                    ->placeholder('Enter vessel engine export ID'),

                Forms\Components\TextInput::make('employment_vessel_name')
                    ->label('Employment Vessel Name')
                    ->placeholder('Enter employment vessel name'),

                Forms\Components\TextInput::make('client_id')
                    ->label('Client')
                    ->placeholder('Enter client'),

                Forms\Components\TextInput::make('vessel_client_id')
                    ->label('Vessel Client')
                    ->placeholder('Enter vessel client'),

                Forms\Components\TextInput::make('contract_template_id')
                    ->label('Contract Template')
                    ->placeholder('Enter contract template'),

                Forms\Components\TextInput::make('vessel_year_built')
                    ->label('Year Built')
                    ->placeholder('Enter year built'),

                Forms\Components\TextInput::make('vessel_grt')
                    ->label('Gross Registered Tonnage (GRT)')
                    ->placeholder('Enter GRT'),

                Forms\Components\TextInput::make('cpr_template_id')
                    ->label('CPR Template'),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('seaman_full_name')
                    ->label('Seaman Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('rank_name')
                    ->label('Rank Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('vessel_name')
                    ->label('Vessel Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('vessel_type_name')
                    ->label('Vessel Type')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('on_date')
                    ->label('Sign On')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('off_date')
                    ->label('Sign Off')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('service_days')
                    ->label('Contract Duration')
                    ->formatStateUsing(function ($record) {
                        $days = $record->service_days;
                        $years = floor($days / 365);
                        $months = floor(($days % 365) / 30);
                        $remainingDays = $days % 365 % 30;

                        return $years ? "{$years} year/s, {$months} months, {$remainingDays} days" : "{$months} months, {$remainingDays} days";
                    })
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->defaultSort('on_date', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmploymentHistories::route('/'),
            'create' => Pages\CreateEmploymentHistory::route('/create'),
            'edit' => Pages\EditEmploymentHistory::route('/{record}/edit'),
        ];
    }
}
