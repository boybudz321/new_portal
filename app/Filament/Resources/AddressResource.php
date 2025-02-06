<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AddressResource\Pages;
use App\Models\Address;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class AddressResource extends Resource
{
    protected static ?string $model = Address::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $navigationGroup = 'Seafarer Management';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\Select::make('reference_type')
    //                 ->label('Reference Type')
    //                 ->placeholder('Select reference type'),

    //             Forms\Components\TextInput::make('referencing_id')
    //                 ->label('Reference ID')
    //                 ->numeric()
    //                 ->placeholder('Enter reference ID'),

    //             Forms\Components\Toggle::make('is_primary')
    //                 ->label('Primary Address')
    //                 ->required(),

    //             Forms\Components\TextInput::make('name')
    //                 ->label('Name')
    //                 ->required()
    //                 ->placeholder('Enter name'),

    //             Forms\Components\TextInput::make('station')
    //                 ->label('Station')
    //                 ->placeholder('Enter station'),

    //             Forms\Components\TextInput::make('city')
    //                 ->label('City')
    //                 ->required()
    //                 ->placeholder('Enter city'),

    //             Forms\Components\TextInput::make('country_id')
    //                 ->label('Country ID')
    //                 ->numeric()
    //                 ->placeholder('Enter country ID'),

    //             Forms\Components\TextInput::make('postal_index')
    //                 ->label('Postal Code')
    //                 ->placeholder('Enter postal code'),

    //             Forms\Components\TextInput::make('fax')
    //                 ->label('Fax')
    //                 ->placeholder('Enter fax'),

    //             Forms\Components\TextInput::make('email')
    //                 ->label('Email')
    //                 ->email()
    //                 ->placeholder('Enter email'),

    //             Forms\Components\Toggle::make('not_email_event')
    //                 ->label('Disable Email Notifications'),

    //             Forms\Components\Toggle::make('not_sms_event')
    //                 ->label('Disable SMS Notifications'),

    //             Forms\Components\TextInput::make('phone')
    //                 ->label('Phone')
    //                 ->tel()
    //                 ->placeholder('Enter phone number'),

    //             Forms\Components\TextInput::make('mobile_phone')
    //                 ->label('Mobile Phone')
    //                 ->tel()
    //                 ->placeholder('Enter mobile number'),

    //             Forms\Components\TextInput::make('county')
    //                 ->label('County')
    //                 ->placeholder('Enter county'),

    //             Forms\Components\TextInput::make('skype_name')
    //                 ->label('Skype')
    //                 ->placeholder('Enter Skype username'),

    //             Forms\Components\TextInput::make('lang_id')
    //                 ->label('Language ID')
    //                 ->numeric()
    //                 ->placeholder('Enter language ID'),

    //             Forms\Components\TextInput::make('airport')
    //                 ->label('Airport')
    //                 ->placeholder('Enter airport'),

    //             Forms\Components\TextInput::make('airport_id')
    //                 ->label('Airport ID')
    //                 ->numeric()
    //                 ->placeholder('Enter airport ID'),

    //             Forms\Components\TextInput::make('_check_sum')
    //                 ->label('Check Sum')
    //                 ->placeholder('Enter check sum'),

    //             Forms\Components\TextInput::make('airport_code')
    //                 ->label('Airport Code')
    //                 ->placeholder('Enter airport code'),

    //             Forms\Components\TextInput::make('airport_name')
    //                 ->label('Airport Name')
    //                 ->placeholder('Enter airport name'),

    //             Forms\Components\TextInput::make('country_name')
    //                 ->label('Country Name')
    //                 ->placeholder('Enter country name'),

    //             Forms\Components\TextInput::make('country_icao_a2')
    //                 ->label('Country ICAO A2')
    //                 ->placeholder('Enter country ICAO A2'),

    //             Forms\Components\TextInput::make('country_icao_a3')
    //                 ->label('Country ICAO A3')
    //                 ->placeholder('Enter country ICAO A3'),

    //             Forms\Components\TextInput::make('country_icao_n3')
    //                 ->label('Country ICAO N3')
    //                 ->placeholder('Enter country ICAO N3'),
    //         ]);
    // }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('reference_type')
                    ->label('Reference Type')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('referencing_id')
                    ->label('Reference ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('station')
                    ->label('Station')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('city')
                    ->label('City')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('country_id')
                    ->label('Country ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('postal_index')
                    ->label('Postal Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('fax')
                    ->label('Fax')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\IconColumn::make('not_email_event')
                    ->label('Email Notifications Disabled')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('not_sms_event')
                    ->label('SMS Notifications Disabled')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('mobile_phone')
                    ->label('Mobile Phone')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('county')
                    ->label('County')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('skype_name')
                    ->label('Skype')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('lang_id')
                    ->label('Language ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('airport')
                    ->label('Airport')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('airport_id')
                    ->label('Airport ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('_check_sum')
                    ->label('Check Sum')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('airport_code')
                    ->label('Airport Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('airport_name')
                    ->label('Airport Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('country_name')
                    ->label('Country Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('country_icao_a2')
                    ->label('Country ICAO A2')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('country_icao_a3')
                    ->label('Country ICAO A3')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('country_icao_n3')
                    ->label('Country ICAO N3')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created Date')
                    ->dateTime()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Last Updated')
                    ->dateTime()
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
            ]);
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
            'index' => Pages\ListAddresses::route('/'),
            'create' => Pages\CreateAddress::route('/create'),
            'edit' => Pages\EditAddress::route('/{record}/edit'),
        ];
    }
}
