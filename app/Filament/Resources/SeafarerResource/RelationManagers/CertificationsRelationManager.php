<?php

namespace App\Filament\Resources\SeafarerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CertificationsRelationManager extends RelationManager
{
    protected static string $relationship = 'certifications';

    protected static ?string $recordTitleAttribute = 'cert_name';

    public static ?string $navigationLabel = 'Certifications';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                // Certificate Basic Info
                Tables\Columns\TextColumn::make('cert_name')
                    ->label('Certificate Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('licence_number')
                    ->label('License Number')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('cert_stcw_code')
                    ->label('STCW Code')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Validity Status
                Tables\Columns\IconColumn::make('is_valid')
                    ->label('Valid')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_verified')
                    ->label('Verified')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_unlimited')
                    ->label('Unlimited')
                    ->boolean()
                    ->sortable(),

                // Dates
                Tables\Columns\TextColumn::make('from_date')
                    ->label('From Date')
                    ->date()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('to_date')
                    ->label('To Date')
                    ->date()
                    ->sortable()
                    ->placeholder('N/A'),

                // Validity Period
                Tables\Columns\TextColumn::make('expire_days')
                    ->label('Days to Expire')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('expire_months')
                    ->label('Months to Expire')
                    ->numeric()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('expiry_status')
                    ->label('Expiry Status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Valid' => 'success',
                        'Warning' => 'warning',
                        'Critical' => 'danger',
                        'Expired' => 'danger',
                        'No Expiry' => 'info',
                        default => 'gray',
                    })
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Issuer Information
                Tables\Columns\TextColumn::make('issuer')
                    ->label('Issuer')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('issuer_country')
                    ->label('Issuer Country')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('issuer_country_name')
                    ->label('Issuer Country Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Certificate Properties
                Tables\Columns\IconColumn::make('is_flag')
                    ->label('Flag Certificate')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_required')
                    ->label('Required')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_confidential')
                    ->label('Confidential')
                    ->boolean()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_archive')
                    ->label('Archived')
                    ->boolean()
                    ->sortable(),

                // Group Information
                Tables\Columns\TextColumn::make('group_id')
                    ->label('Group ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('group_name')
                    ->label('Group Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Export Information
                Tables\Columns\TextColumn::make('cert_export_id')
                    ->label('Export ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // Notes
                Tables\Columns\TextColumn::make('notes')
                    ->label('Notes')
                    ->wrap()
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                // System Fields
                Tables\Columns\TextColumn::make('_check_sum')
                    ->label('Check Sum')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->defaultSort('to_date', 'asc')  // Sort by expiry date by default
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->groups([
                'group_name',
            ]);
    }
}
