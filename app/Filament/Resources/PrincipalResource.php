<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Principal;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PrincipalResource\Pages;
use App\Filament\Resources\PrincipalResource\RelationManagers;

class PrincipalResource extends Resource
{
    protected static ?string $model = Principal::class;

    protected static ?string $navigationIcon = 'heroicon-o-building-office';

    protected static ?string $navigationGroup = 'Data';

    protected static ?int $navigationSort = 4;

    protected static ?string $tenantOwnershipRelationshipName  = 'company';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('company_id')
                    ->label('Company')
                    ->required()
                    ->default(Filament::getTenant()->name)
                    ->disabled()
                    ->maxLength(100),
                Forms\Components\TextInput::make('PrinCode')
                    ->label('Principal Code')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('Abbrv')
                    ->label('Abbreviation')
                    ->maxLength(100),
                Forms\Components\TextInput::make('Name')
                    ->label('Name')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('Addr')
                    ->label('Address')
                    ->maxLength(100),
                Forms\Components\TextInput::make('CntryCode')
                    ->label('Country Code')
                    ->maxLength(100),
                Forms\Components\TextInput::make('Phone')
                    ->label('Phone')
                    ->tel()
                    ->maxLength(100),
                Forms\Components\TextInput::make('Telefax')
                    ->label('Telefax')
                    ->maxLength(100),
                Forms\Components\TextInput::make('Email')
                    ->label('Email')
                    ->email()
                    ->maxLength(100),
                Forms\Components\Toggle::make('ActCode')
                    ->label('Active'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('PrinCode')
                    ->label('ID')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Name')
                    ->searchable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('officePersonnels.name')
                    ->label('Office Personnel')
                    ->searchable()
                    ->placeholder('N/A')
                    ->badge(),
                Tables\Columns\IconColumn::make('ActCode')
                    ->boolean()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('id', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\VesselsRelationManager::class,
            // // RelationManagers\SeafarersRelationManager::class,
            // RelationManagers\OfficePersonnelRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPrincipals::route('/'),
            'create' => Pages\CreatePrincipal::route('/create'),
            'view' => Pages\ViewPrincipal::route('/{record}'),
            'edit' => Pages\EditPrincipal::route('/{record}/edit'),
        ];
    }
}
