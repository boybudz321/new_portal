<?php

namespace App\Filament\Resources\PrincipalResource\RelationManagers;

use App\Filament\Resources\OfficePersonnelResource;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class OfficePersonnelRelationManager extends RelationManager
{
    protected static string $relationship = 'officePersonnels';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->label('User')
                    ->relationship('user', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),
                Forms\Components\TextInput::make('name')
                    ->label('Name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('email')
                    ->label('Email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('position')
                    ->label('Position')
                    ->maxLength(255),
                Forms\Components\Select::make('principals')
                    ->label('Principals')
                    ->relationship('principals', 'Name')
                    ->searchable()
                    ->preload()
                    ->default(fn() => $this->ownerRecord->principal_id)
                    ->live(),
                Forms\Components\TextInput::make('remarks')
                    ->label('Remarks')
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->label('Name')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('email')
                    ->label('Email')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('position')
                    ->label('Position')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('user.name')
                    ->label('User')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('principals.Name')
                    ->label('Principals')
                    ->searchable()
                    ->placeholder('N/A')
                    ->badge(),
                Tables\Columns\TextColumn::make('remarks')
                    ->label('Remarks')
                    ->searchable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->recordTitleAttribute('name')
                    ->recordSelectSearchColumns(['name', 'id']),
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn($record) => OfficePersonnelResource::getUrl('view', ['record' => $record])),
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
