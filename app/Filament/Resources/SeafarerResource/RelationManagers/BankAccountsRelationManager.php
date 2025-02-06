<?php

namespace App\Filament\Resources\SeafarerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BankAccountsRelationManager extends RelationManager
{
    protected static string $relationship = 'bankAccounts';

    protected static ?string $recordTitleAttribute = 'bank_name';

    public static ?string $navigationLabel = 'Bank Accounts';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                // Primary Info
                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\TextColumn::make('bank_name')
                    ->label('Bank Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('account_number')
                    ->label('Account Number')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Bank Details
                Tables\Columns\TextColumn::make('bank_iban_code')
                    ->label('IBAN')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('bank_code')
                    ->label('Bank Code')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('bank_sort_code')
                    ->label('Sort Code')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('currency_code')
                    ->label('Currency')
                    ->searchable()
                    ->placeholder('N/A'),

                // Beneficiary Info
                Tables\Columns\TextColumn::make('beneficiary')
                    ->label('Beneficiary')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('beneficiary_id_code')
                    ->label('Beneficiary ID')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('phone')
                    ->label('Phone')
                    ->searchable()
                    ->placeholder('N/A'),

                // Status
                Tables\Columns\TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'active' => 'success',
                        'inactive' => 'danger',
                        'suspended' => 'warning',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Correspondent Bank
                Tables\Columns\TextColumn::make('correspondent_bank')
                    ->label('Correspondent Bank')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('correspondent_bank_account')
                    ->label('Correspondent Account')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('correspondent_bank_code')
                    ->label('Correspondent Code')
                    ->searchable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                // Add filters if needed
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
