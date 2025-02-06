<?php

namespace App\Filament\Resources\SeafarerResource\Pages;

use App\Filament\Resources\SeafarerResource;
use App\Models\Seafarer;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Grid;
use Filament\Infolists\Components\Group as ComponentsGroup;

class ViewSeafarer extends ViewRecord
{
    protected static string $model = Seafarer::class;

    protected static string $resource = SeafarerResource::class;

    protected static string $view = 'filament.pages.view-seafarer_stable';

    public ?string $activeTab = 'sea-service';

    protected $queryString = [
        'activeTab',
    ];

    // public function basicInfoList(Infolist $infolist): Infolist
    // {
    //     return $infolist
    //         ->schema([
    //             // Seaman Data Group
    //             ComponentsGroup::make()
    //                 ->schema([
    //                     $this->getBasicPersonalInfoSection(),
    //                 ])
    //                 ->columnSpan(['lg' => 2]),
    //         ]);
    // }

    // Profile Information

    public function personalInfoList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Seaman Data Group
                ComponentsGroup::make()
                    ->schema([
                        $this->getBirthAndAgeSection(),
                        $this->getContactInformationSection(),
                        $this->getRankInformationSection(),
                        $this->getStatusAndRegistrationSection(),
                        $this->getLocationAndAvailabilitySection(),
                        $this->getNationalitySection(),
                        $this->getOfficeInformationSection(),
                        $this->getNotesSection(),
                    ])
                    ->columnSpan(['lg' => 2]),
            ]);
    }

    public function addressList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Address Information Group
                ComponentsGroup::make()
                    ->schema([
                        $this->getPrimaryAddressSection(),
                        $this->getAddressContactSection(),
                        $this->getAddressLocationSection(),
                        $this->getAddressAirportSection(),
                        $this->getAddressCountrySection(),
                    ])
                    ->columnSpan(['lg' => 2])
            ]);
    }

    public function uniformList(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                // Uniform Information Group
                ComponentsGroup::make()
                    ->schema([
                        $this->getUniformSizesSection(),
                        $this->getPhysicalAttributesSection(),
                        $this->getPersonalCharacteristicsSection(),
                        $this->getMedicalInformationSection(),
                    ])
                    ->columnSpan(['lg' => 2])
            ]);
    }

    // public function getBasicPersonalInfoSection(): Section
    // {
    //     return Section::make('Basic Information')
    //         ->schema([
    //             Grid::make(2)
    //                 ->schema([
    //                     TextEntry::make('full_name')
    //                         ->label('Full Name')
    //                         ->placeholder('N/A')
    //                         ->inlineLabel(),
    //                     TextEntry::make('primary_email')
    //                         ->label('Primary Email')
    //                         ->placeholder('N/A')
    //                         ->inlineLabel(),
    //                     TextEntry::make('national_full_name')
    //                         ->label('National Full Name')
    //                         ->placeholder('N/A')
    //                         ->inlineLabel(),
    //                     TextEntry::make('calling_name')
    //                         ->label('Calling Name')
    //                         ->placeholder('N/A')
    //                         ->inlineLabel(),
    //                 ])
    //         ])
    //         ->collapsible();
    // }

    public function getBirthAndAgeSection(): Section
    {
        return Section::make('Birth & Age Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('pp_dob')
                            ->label('Date of Birth')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('pp_pob')
                            ->label('Place of Birth')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('age')
                            ->label('Age')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('sex')
                            ->label('Gender')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('marital_status')
                            ->label('Marital Status')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('child_cnt')
                            ->label('Number of Children')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getContactInformationSection(): Section
    {
        return Section::make('Contact Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('primary_email')
                            ->label('Primary Email')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('primary_mobile')
                            ->label('Primary Mobile')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('primary_postal_index')
                            ->label('Postal Code')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getRankInformationSection(): Section
    {
        return Section::make('Rank Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('rank_name')
                            ->label('Rank')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('rank_short_name')
                            ->label('Rank (Short)')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('rank_long_name')
                            ->label('Rank (Full)')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('rank_export_id')
                            ->label('Rank Export ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getStatusAndRegistrationSection(): Section
    {
        return Section::make('Status & Registration')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('registration_date')
                            ->label('Registration Date')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('online_set_date')
                            ->label('Online Set Date')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('online_date')
                            ->label('Online Date')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('online_datetime')
                            ->label('Online DateTime')
                            ->dateTime()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('client_date')
                            ->label('Client Date')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('status')
                            ->label('Status')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('status_name')
                            ->label('Status Description')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('status_export_id')
                            ->label('Status Export ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getLocationAndAvailabilitySection(): Section
    {
        return Section::make('Location & Availability')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('curr_location')
                            ->label('Current Location')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('curr_location_date')
                            ->label('Location Date')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('available_from')
                            ->label('Available From')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('available_to')
                            ->label('Available To')
                            ->date()
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('available')
                            ->label('Availability Status')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getNationalitySection(): Section
    {
        return Section::make('Nationality & Documentation')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('country_name')
                            ->label('Country')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('country_code')
                            ->label('Country Code')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('citizenship_name')
                            ->label('Citizenship')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('pp_id_code')
                            ->label('Passport ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('pp_country_name')
                            ->label('Passport Country')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('pp_country_code')
                            ->label('Passport Country Code')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('taxation_country_name')
                            ->label('Taxation Country')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('taxation_country_code')
                            ->label('Taxation Country Code')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('taxation_id_code')
                            ->label('Tax ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getOfficeInformationSection(): Section
    {
        return Section::make('Office Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('office_name')
                            ->label('Office')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('office_registered_name')
                            ->label('Registered Office')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('primary_office_id')
                            ->label('Primary Office ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getNotesSection(): Section
    {
        return Section::make('Notes')
            ->schema([
                Grid::make(1)
                    ->schema([
                        TextEntry::make('fast_note')
                            ->label('Quick Notes')
                            ->placeholder('N/A')
                            ->markdown()
                            ->inlineLabel(),
                        TextEntry::make('fast_note2')
                            ->label('Additional Notes')
                            ->placeholder('N/A')
                            ->markdown()
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    // Address Information

    public function getPrimaryAddressSection(): Section
    {
        return Section::make('Primary Address Details')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('addresses.is_primary')
                            ->label('Primary Address')
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.name')
                            ->label('Address Name')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.reference_type')
                            ->label('Reference Type')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.station')
                            ->label('Station')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getAddressContactSection(): Section
    {
        return Section::make('Contact Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('addresses.email')
                            ->label('Email')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.phone')
                            ->label('Phone')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.mobile_phone')
                            ->label('Mobile')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.fax')
                            ->label('Fax')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.skype_name')
                            ->label('Skype')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.not_email_event')
                            ->label('Email Notifications')
                            ->formatStateUsing(fn($state) => $state ? 'Disabled' : 'Enabled')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.not_sms_event')
                            ->label('SMS Notifications')
                            ->formatStateUsing(fn($state) => $state ? 'Disabled' : 'Enabled')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getAddressLocationSection(): Section
    {
        return Section::make('Location Details')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('addresses.city')
                            ->label('City')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.county')
                            ->label('County')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.postal_index')
                            ->label('Postal Code')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.full_address')
                            ->label('Complete Address')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getAddressAirportSection(): Section
    {
        return Section::make('Airport Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('addresses.airport')
                            ->label('Airport')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.airport_id')
                            ->label('Airport ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.airport_code')
                            ->label('Airport Code')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.airport_name')
                            ->label('Airport Name')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    public function getAddressCountrySection(): Section
    {
        return Section::make('Country Information')
            ->schema([
                Grid::make(2)
                    ->schema([
                        TextEntry::make('addresses.country_name')
                            ->label('Country')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.country_id')
                            ->label('Country ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.country_icao_a2')
                            ->label('ICAO Code (A2)')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.country_icao_a3')
                            ->label('ICAO Code (A3)')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.country_icao_n3')
                            ->label('ICAO Code (N3)')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                        TextEntry::make('addresses.lang_id')
                            ->label('Language ID')
                            ->placeholder('N/A')
                            ->inlineLabel(),
                    ])
            ])
            ->collapsible();
    }

    // Uniform Information

    public function getUniformSizesSection(): Section
    {
        return Section::make('Uniform Sizes')
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextEntry::make('chest')
                            ->label('Chest')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('boilersuit')
                            ->label('Boiler Suit Size')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('boots')
                            ->label('Boots Size')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('sweater')
                            ->label('Sweater Size')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('trousers')
                            ->label('Trousers Size')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('pilot_shirt')
                            ->label('Pilot Shirt Size')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                    ])
            ])
            ->collapsible();
    }

    public function getPhysicalAttributesSection(): Section
    {
        return Section::make('Physical Attributes')
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextEntry::make('height')
                            ->label('Height')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('weight')
                            ->label('Weight')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('bmi')
                            ->label('BMI')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('eyes_color')
                            ->label('Eyes Color')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('hair_color')
                            ->label('Hair Color')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                    ])
            ])
            ->collapsible();
    }

    public function getPersonalCharacteristicsSection(): Section
    {
        return Section::make('Personal Characteristics')
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextEntry::make('seaman_id')
                            ->label('Seaman ID')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('main_member')
                            ->label('Main Member')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->placeholder('N/A'),
                        TextEntry::make('smoking')
                            ->label('Smoking')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->placeholder('N/A'),
                        TextEntry::make('drinking')
                            ->label('Drinking')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->placeholder('N/A'),
                        TextEntry::make('tattoos')
                            ->label('Tattoos')
                            ->inlineLabel()
                            ->formatStateUsing(fn($state) => $state ? 'Yes' : 'No')
                            ->placeholder('N/A'),
                        TextEntry::make('religion_name')
                            ->label('Religion')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                    ])
            ])
            ->collapsible();
    }

    public function getMedicalInformationSection(): Section
    {
        return Section::make('Medical Information')
            ->schema([
                Grid::make(3)
                    ->schema([
                        TextEntry::make('blood_type')
                            ->label('Blood Type')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('blood_rhesus')
                            ->label('Blood Rhesus')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('insurance_name')
                            ->label('Insurance Name')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('membership_no')
                            ->label('Membership Number')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('medical_plan')
                            ->label('Medical Plan')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('insurance_from_date')
                            ->label('Insurance From Date')
                            ->inlineLabel()
                            ->date()
                            ->placeholder('N/A'),
                        TextEntry::make('insurance_to_date')
                            ->label('Insurance To Date')
                            ->inlineLabel()
                            ->date()
                            ->placeholder('N/A'),
                        TextEntry::make('contact_no')
                            ->label('Contact Number')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('chronic_illness')
                            ->label('Chronic Illness')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('allergies')
                            ->label('Allergies')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                        TextEntry::make('medication')
                            ->label('Medication')
                            ->inlineLabel()
                            ->placeholder('N/A'),
                    ])
            ])
            ->collapsible();
    }

    protected function getHeaderActions(): array
    {
        return [
            // Actions\EditAction::make(),
        ];
    }
}
