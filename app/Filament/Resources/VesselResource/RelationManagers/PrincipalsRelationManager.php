<?php

namespace App\Filament\Resources\VesselResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class PrincipalsRelationManager extends RelationManager
{
    protected static string $relationship = 'principal';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('PrinCode')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('PrinCode')
            ->columns([
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('officePersonnels.name')
                    ->label('Office Personnel')
                    ->searchable()
                    ->placeholder('N/A')
                    ->badge(),
                Tables\Columns\TextColumn::make('PrinCode')
                    ->label('Principal Code')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Name')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Addr')
                    ->label('Address')
                    ->searchable()
                    ->limit(20)
                    ->tooltip(fn($record) => $record->Addr)
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('CntryCode')
                    ->label('Country Code')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Phone')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Telefax')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Email')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\IconColumn::make('ActCode')
                    ->boolean()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                // Tables\Actions\CreateAction::make(),
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
