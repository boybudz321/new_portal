<?php

namespace App\Filament\Resources;

use App\Filament\Resources\UniformDataResource\Pages;
use App\Filament\Resources\UniformDataResource\RelationManagers;
use App\Models\UniformData;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;

class UniformDataResource extends Resource
{
    protected static ?string $model = UniformData::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationLabel = 'Uniform Data';

    protected static ?string $modelLabel = 'Uniform Data';

    protected static ?string $pluralModelLabel = 'Uniform Data';

    protected static ?string $navigationGroup = 'Seafarer Management';

    public static function shouldRegisterNavigation(): bool
    {
        return false;
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('seaman_id')
                    ->label('Seaman ID')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('height')
                    ->label('Height')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('chest')
                    ->label('Chest')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('boilersuit')
                    ->label('Boiler Suit Size')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('boots')
                    ->label('Boots Size')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('sweater')
                    ->label('Sweater Size')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('trousers')
                    ->label('Trousers Size')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('pilot_shirt')
                    ->label('Pilot Shirt Size')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('weight')
                    ->label('Weight')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('bmi')
                    ->label('BMI')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('eyes_color')
                    ->label('Eyes Color')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('hair_color')
                    ->label('Hair Color')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('blood_type')
                    ->label('Blood Type')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('blood_rhesus')
                    ->label('Blood Rhesus')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                IconColumn::make('main_member')
                    ->label('Main Member')
                    ->boolean()
                    ->sortable()
                    ->searchable(),

                IconColumn::make('smoking')
                    ->label('Smoking')
                    ->boolean()
                    ->sortable()
                    ->searchable(),

                IconColumn::make('drinking')
                    ->label('Drinking')
                    ->boolean()
                    ->sortable()
                    ->searchable(),

                IconColumn::make('tattoos')
                    ->label('Tattoos')
                    ->boolean()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('religion_name')
                    ->label('Religion')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('insurance_name')
                    ->label('Insurance Name')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('membership_no')
                    ->label('Membership Number')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('medical_plan')
                    ->label('Medical Plan')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('insurance_from_date')
                    ->label('Insurance From Date')
                    ->sortable()
                    ->searchable()
                    ->date()
                    ->placeholder('N/A'),

                TextColumn::make('insurance_to_date')
                    ->label('Insurance To Date')
                    ->sortable()
                    ->searchable()
                    ->date()
                    ->placeholder('N/A'),

                TextColumn::make('contact_no')
                    ->label('Contact Number')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('chronic_illness')
                    ->label('Chronic Illness')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('allergies')
                    ->label('Allergies')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),

                TextColumn::make('medication')
                    ->label('Medication')
                    ->sortable()
                    ->searchable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListUniformData::route('/'),
            'create' => Pages\CreateUniformData::route('/create'),
            'edit' => Pages\EditUniformData::route('/{record}/edit'),
        ];
    }
}
