<?php

namespace App\Filament\Resources\SeafarerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class RelativesRelationManager extends RelationManager
{
    protected static string $relationship = 'relatives';
    public static ?string $navigationLabel = 'Relatives';

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('seaman_id')
                    ->label('Seaman ID')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('relative_id')
                    ->label('Relative ID')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_primary')
                    ->label('Primary')
                    ->boolean()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('name')
                    ->label('First Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('surname')
                    ->label('Last Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('sex')
                    ->label('Gender')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('id_code')
                    ->label('ID Code')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_employed')
                    ->label('Employed')
                    ->boolean()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('occupation')
                    ->label('Occupation')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('employer_name')
                    ->label('Employer Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_owwa')
                    ->label('OWWA Member')
                    ->boolean()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\IconColumn::make('is_phil_health')
                    ->label('PhilHealth Member')
                    ->boolean()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('birth_date')
                    ->label('Birth Date')
                    ->date()
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('age')
                    ->label('Age')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('type_name')
                    ->label('Type')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_name')
                    ->label('Address')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_city')
                    ->label('City')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_county')
                    ->label('County')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('country_id')
                    ->label('Country')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_postal_index')
                    ->label('Postal Code')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_fax')
                    ->label('Fax')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_email')
                    ->label('Email')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_phone')
                    ->label('Phone')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('full_address')
                    ->label('Full Address')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('address_country_name')
                    ->label('Address Country')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('country_name')
                    ->label('Country Name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('country_icao_a2')
                    ->label('ICAO Code (A2)')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('country_icao_a3')
                    ->label('ICAO Code (A3)')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('country_icao_n3')
                    ->label('ICAO Code (N3)')
                    ->searchable()
                    ->sortable(),
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
            ->defaultSort('name', 'asc');
    }
}
