<?php

namespace App\Filament\Resources\SeafarerResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class VesselsRelationManager extends RelationManager
{
    protected static string $relationship = 'vessels';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('VslCode')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('Name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('VslTypeCode')
                    ->required()
                    ->maxLength(100),
                // Add more fields as needed
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('VslCode'),
                Tables\Columns\TextColumn::make('Name'),
                Tables\Columns\TextColumn::make('VslTypeCode'),
                // Add more columns as needed
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
