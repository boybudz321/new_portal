<?php

namespace App\Filament\Resources\PrincipalResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SeafarersRelationManager extends RelationManager
{
    protected static string $relationship = 'seafarers';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('IDNbr')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('LName')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('FName')
                    ->required()
                    ->maxLength(100),
                // Add more fields as needed
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('IDNbr'),
                Tables\Columns\TextColumn::make('LName'),
                Tables\Columns\TextColumn::make('FName'),
                // Add more columns as needed
            ])
            ->filters([
                //
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
