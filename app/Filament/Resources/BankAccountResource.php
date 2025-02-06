<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BankAccountResource\Pages;
use App\Models\BankAccount;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class BankAccountResource extends Resource
{
    protected static ?string $model = BankAccount::class;

    protected static ?string $navigationIcon = 'heroicon-o-credit-card';

    protected static ?string $navigationGroup = 'Seafarer Management';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    // public static function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\TextInput::make('seaman_id')
    //                 ->label('Seaman ID')
    //                 ->numeric()
    //                 ->placeholder('Enter seaman ID'),

    //             Forms\Components\TextInput::make('relative_id')
    //                 ->label('Relative ID')
    //                 ->numeric()
    //                 ->placeholder('Enter relative ID'),

    //             Forms\Components\TextInput::make('beneficiary')
    //                 ->label('Beneficiary')
    //                 ->required()
    //                 ->placeholder('Enter beneficiary name'),

    //             Forms\Components\TextInput::make('beneficiary_id_code')
    //                 ->label('Beneficiary ID Code')
    //                 ->placeholder('Enter beneficiary ID code'),

    //             Forms\Components\TextInput::make('beneficiary_address')
    //                 ->label('Beneficiary Address')
    //                 ->placeholder('Enter beneficiary address'),

    //             Forms\Components\TextInput::make('email')
    //                 ->label('Email')
    //                 ->email()
    //                 ->placeholder('Enter email'),

    //             Forms\Components\TextInput::make('phone')
    //                 ->label('Phone')
    //                 ->tel()
    //                 ->placeholder('Enter phone number'),

    //             Forms\Components\TextInput::make('account_number')
    //                 ->label('Account Number')
    //                 ->required()
    //                 ->placeholder('Enter account number'),

    //             Forms\Components\TextInput::make('bank')
    //                 ->label('Bank')
    //                 ->placeholder('Enter bank'),

    //             Forms\Components\TextInput::make('bank_name_id')
    //                 ->label('Bank Name ID')
    //                 ->placeholder('Enter bank name ID'),

    //             Forms\Components\TextInput::make('country_id')
    //                 ->label('Country ID')
    //                 ->placeholder('Enter country ID'),

    //             Forms\Components\TextInput::make('address')
    //                 ->label('Address')
    //                 ->placeholder('Enter address'),

    //             Forms\Components\TextInput::make('bank_details')
    //                 ->label('Bank Details')
    //                 ->placeholder('Enter bank details'),

    //             Forms\Components\TextInput::make('bank_iban_code')
    //                 ->label('Bank IBAN Code')
    //                 ->placeholder('Enter bank IBAN code'),

    //             Forms\Components\TextInput::make('bank_code')
    //                 ->label('Bank Code')
    //                 ->placeholder('Enter bank code'),

    //             Forms\Components\TextInput::make('bank_sort_code')
    //                 ->label('Bank Sort Code')
    //                 ->placeholder('Enter bank sort code'),

    //             Forms\Components\TextInput::make('currency_id')
    //                 ->label('Currency ID')
    //                 ->placeholder('Enter currency ID'),

    //             Forms\Components\TextInput::make('correspondent_bank')
    //                 ->label('Correspondent Bank')
    //                 ->placeholder('Enter correspondent bank'),

    //             Forms\Components\TextInput::make('correspondent_bank_account')
    //                 ->label('Correspondent Bank Account')
    //                 ->placeholder('Enter correspondent bank account'),

    //             Forms\Components\TextInput::make('correspondent_bank_code')
    //                 ->label('Correspondent Bank Code')
    //                 ->placeholder('Enter correspondent bank code'),

    //             Forms\Components\TextInput::make('lang_id')
    //                 ->label('Language ID')
    //                 ->placeholder('Enter language ID'),

    //             Forms\Components\TextInput::make('status')
    //                 ->label('Status')
    //                 ->placeholder('Enter status'),

    //             Forms\Components\TextInput::make('status_name')
    //                 ->label('Status Name')
    //                 ->placeholder('Enter status name'),

    //             Forms\Components\Toggle::make('is_mpo')
    //                 ->label('Is MPO'),

    //             Forms\Components\Toggle::make('is_primary')
    //                 ->label('Is Primary')
    //                 ->required(),

    //             Forms\Components\TextInput::make('_check_sum')
    //                 ->label('Check Sum')
    //                 ->placeholder('Enter check sum'),

    //             Forms\Components\TextInput::make('bank_name')
    //                 ->label('Bank Name')
    //                 ->placeholder('Enter bank name'),

    //             Forms\Components\TextInput::make('currency_code')
    //                 ->label('Currency Code')
    //                 ->placeholder('Enter currency code'),

    //             Forms\Components\TextInput::make('country_name')
    //                 ->label('Country Name')
    //                 ->placeholder('Enter country name'),

    //             Forms\Components\TextInput::make('country_code')
    //                 ->label('Country Code')
    //                 ->placeholder('Enter country code'),

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
                Tables\Columns\TextColumn::make('seaman_id')
                    ->label('Seaman ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('beneficiary')
                    ->label('Beneficiary')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('account_number')
                    ->label('Account Number')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Bank Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('bank_iban_code')
                    ->label('IBAN Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('currency_code')
                    ->label('Currency')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('country_name')
                    ->label('Country')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\IconColumn::make('is_mpo')
                    ->label('MPO')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean()
                    ->sortable(),

                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('bank_code')
                    ->label('Bank Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('bank_sort_code')
                    ->label('Sort Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('correspondent_bank')
                    ->label('Correspondent Bank')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('correspondent_bank_account')
                    ->label('Correspondent Account')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('correspondent_bank_code')
                    ->label('Correspondent Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('beneficiary_address')
                    ->label('Beneficiary Address')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('beneficiary_id_code')
                    ->label('Beneficiary ID')
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
            'index' => Pages\ListBankAccounts::route('/'),
            'create' => Pages\CreateBankAccount::route('/create'),
            'edit' => Pages\EditBankAccount::route('/{record}/edit'),
        ];
    }
}
