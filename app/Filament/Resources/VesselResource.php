<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vessel;
use Filament\Forms\Form;
use App\Models\Principal;
use Filament\Tables\Table;
use Filament\Facades\Filament;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\VesselResource\Pages;
use App\Filament\Resources\VesselResource\RelationManagers;

class VesselResource extends Resource
{
    protected static ?string $model = Vessel::class;
    protected static ?string $navigationIcon = 'heroicon-o-paper-airplane';
    protected static ?string $navigationGroup = 'Data';
    protected static ?string $navigationLabel = 'Vessel List';
    protected static ?int $navigationSort = 1;

    protected static ?string $tenantRelationshipName = 'principals';

    // public static function getEloquentQuery(): Builder
    // {
    //     $query = parent::getEloquentQuery();

    //     $user = auth()->user();

    //     if ($user->hasRole(['admin', 'super_admin'])) {
    //         return $query;
    //     }

    //     if ($user->hasRole('principal')) {
    //         return $query->where('PrinCode', $user->principal?->PrinCode);
    //     }

    //     if ($user->hasRole('office_personnel')) {
    //         return $query->whereIn('PrinCode', $user->officePersonnel?->principals()->pluck('PrinCode') ?? []);
    //     }

    //     return $query->whereRaw('1 = 0');
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // Basic Vessel Information
                Section::make('Basic Information')
                    ->schema([

                        Forms\Components\Select::make('PrinCode')
                            ->label('Principal')
                            ->options(fn() => Principal::pluck('Name', 'PrinCode'))
                            ->searchable()
                            ->placeholder('Select Principal')
                            ->columnSpan(1)
                            ->inlineLabel()
                            ->preload()
                            ->required(),
                        Forms\Components\TextInput::make('VslCode')
                            ->label('Vessel Code')
                            ->maxLength(100)
                            ->placeholder('Enter vessel code')
                            ->unique(ignoreRecord: true)
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('Name')
                            ->label('Vessel Name')
                            ->maxLength(100)
                            ->placeholder('Enter vessel name')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('VslTypeCode')
                            ->label('Vessel Type')
                            ->placeholder('Select vessel type')
                            ->inlineLabel(),
                    ])->columns(2),

                // Registration Details
                Section::make('Registration Details')
                    ->schema([
                        Forms\Components\TextInput::make('OffNbr')
                            ->label('Official Number')
                            ->maxLength(100)
                            ->placeholder('Enter official number')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('PortofReg')
                            ->label('Port of Registration')
                            ->maxLength(100)
                            ->placeholder('Enter port of registration')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('Classf')
                            ->label('Classification')
                            ->maxLength(100)
                            ->placeholder('Enter vessel classification')
                            ->inlineLabel(),

                        Forms\Components\DatePicker::make('YearBuilt')
                            ->label('Year Built')
                            ->maxDate(now())
                            ->displayFormat('Y')
                            ->inlineLabel(),
                    ])->columns(2),

                // Technical Specifications
                Section::make('Technical Specifications')
                    ->schema([
                        Forms\Components\TextInput::make('GrossTon')
                            ->label('Gross Tonnage')
                            ->numeric()
                            ->maxLength(100)
                            ->placeholder('Enter gross tonnage')
                            ->suffix('GT')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('DeadWt')
                            ->label('Deadweight')
                            ->numeric()
                            ->maxLength(100)
                            ->placeholder('Enter deadweight')
                            ->suffix('DWT')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('NetTon')
                            ->label('Net Tonnage')
                            ->numeric()
                            ->maxLength(100)
                            ->placeholder('Enter net tonnage')
                            ->suffix('NT')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('ship_size')
                            ->label('Ship Size')
                            ->maxLength(20)
                            ->placeholder('Enter ship size')
                            ->suffix('m')
                            ->inlineLabel(),
                    ])->columns(2),

                // Engine Information
                Section::make('Engine Details')
                    ->schema([
                        Forms\Components\TextInput::make('EngType')
                            ->label('Engine Type')
                            ->placeholder('Select engine type')
                            ->inlineLabel(),

                        Forms\Components\TextInput::make('EngPower')
                            ->label('Engine Power')
                            ->numeric()
                            ->maxLength(100)
                            ->placeholder('Enter engine power')
                            ->suffix('kW')
                            ->inlineLabel(),
                    ])->columns(2),

                // Additional Information
                Section::make('Additional Information')
                    ->schema([
                        Forms\Components\Toggle::make('ActCode')
                            ->label('Active Status')
                            ->onColor('success')
                            ->offColor('danger')
                            ->inlineLabel(),

                        Forms\Components\DatePicker::make('risk_date')
                            ->label('Risk Assessment Date')
                            ->placeholder('Select date')
                            ->inlineLabel(),

                        Forms\Components\FileUpload::make('photo_directory')
                            ->label('Vessel Photos')
                            ->directory('vessel-photos')
                            ->image()
                            ->multiple()
                            ->inlineLabel(),

                        Forms\Components\FileUpload::make('risk_attachment')
                            ->label('Risk Assessment Documents')
                            ->directory('risk-documents')
                            ->acceptedFileTypes(['application/pdf'])
                            ->multiple()
                            ->inlineLabel(),
                    ])->columns(2),
                // Avatar
                Section::make('Avatar')
                    ->schema([
                        Forms\Components\FileUpload::make('avatar')
                            ->label('Vessel Avatar')
                            ->directory('vessel-avatar')
                            ->image()
                            ->inlineLabel(),
                        // Forms\Components\TextInput::make('company_id')
                        // ->label('Company')
                        // ->required()
                        // ->default(Filament::getTenant()->id)
                        // ->disabled()
                        // ->maxLength(100),
                    ])->columns(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('vessel_id')
                //     ->label('VID')
                //     ->searchable()
                //     ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('VslCode')
                    ->label('ID')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('Name')
                    ->searchable()
                    ->placeholder('N/A'),
                // Tables\Columns\TextColumn::make('PrinCode')
                //     ->label('Principal ID')
                //     ->searchable()
                //     ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('principal.Name')
                    ->label('Principal Name')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('OffNbr')
                    ->label('Office No.')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('PortofReg')
                    ->label('Port of Registration')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('YearBuilt')
                    ->label('Year Built')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\TextColumn::make('GrossTon')
                    ->label('Gross Tonnage')
                    ->searchable()
                    ->placeholder('N/A'),
                Tables\Columns\IconColumn::make('ActCode')
                    ->label('Active')
                    ->boolean(),
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
            ]);
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\SeafarersRelationManager::class,
            RelationManagers\PrincipalsRelationManager::class,
            RelationManagers\DocumentsRelationManager::class,
            RelationManagers\DrillexercisesRelationManager::class,
            RelationManagers\SafetiesRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListVessels::route('/'),
            'create' => Pages\CreateVessel::route('/create'),
            'view' => Pages\ViewVessel::route('/{record}'),
            'edit' => Pages\EditVessel::route('/{record}/edit'),
        ];
    }
}
