<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vessel;
use App\Models\Seafarer;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\SeafarerResource\Pages;
use App\Filament\Resources\SeafarerResource\RelationManagers;

class SeafarerResource extends Resource
{
    protected static ?string $model = Seafarer::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-group';
    protected static ?string $navigationGroup = 'Data';
    protected static ?int $navigationSort = 3;

    protected static ?string $tenantRelationshipName  = 'company';

    // public static function getEloquentQuery(): Builder
    // {
    //     $query = parent::getEloquentQuery();

    //     $user = auth()->user();

    //     // Admin and Super Admin see all records
    //     if ($user->hasRole(['admin', 'super_admin'])) {
    //         return $query;
    //     }

    //     // For Principal role
    //     if ($user->hasRole('principal')) {
    //         return $query->whereHas('vessel', function ($vesselQuery) {
    //             $vesselQuery->where('PrinCode', auth()->user()->principal->PrinCode);
    //         });
    //     }

    //     // For Office Personnel role
    //     if ($user->hasRole('office_personnel')) {
    //         return $query->whereHas('vessel', function ($vesselQuery) {
    //             $vesselQuery->whereHas('principal', function ($principalQuery) {
    //                 $principalQuery->whereHas('officePersonnels', function ($officeQuery) {
    //                     $officeQuery->where('office_personnel_id', auth()->user()->officePersonnel->id);
    //                 });
    //             });
    //         });
    //     }

    //     // Return no records for any other role
    //     return $query->whereRaw('1 = 0');
    // }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Photos')
                    ->schema([
                    Forms\Components\FileUpload::make('avatar')
                        ->label('Seafarer Avatar')
                        ->directory('seafarer-avatar')
                        ->image()
                        ->inlineLabel(),
                    Forms\Components\FileUpload::make('esignature')
                        ->label('Seafarer Signature')
                        ->directory('seafarer-esignature')
                        ->image()
                        ->inlineLabel(),
                ])->columns(2),
            ]);
        // return $form
        //     ->schema([
        //         Forms\Components\TextInput::make('IDNbr')
        //             ->label('ID Number')
        //             ->required()
        //             ->maxLength(100),
        //         Forms\Components\TextInput::make('LName')
        //             ->label('Last Name')
        //             ->required()
        //             ->maxLength(100),
        //         Forms\Components\TextInput::make('FName')
        //             ->label('First Name')
        //             ->required()
        //             ->maxLength(100),
        //         Forms\Components\TextInput::make('MName')
        //             ->label('Middle Name')
        //             ->maxLength(100),
        //         Forms\Components\DatePicker::make('DOB')
        //             ->label('Date of Birth')
        //             ->required(),
        //         Forms\Components\TextInput::make('POB')
        //             ->label('Place of Birth')
        //             ->required()
        //             ->maxLength(100),
        //         Forms\Components\TextInput::make('NatCode')
        //             ->label('National Code')
        //             ->required()
        //             ->maxLength(100),
        //         Forms\Components\Toggle::make('cdp')
        //             ->label('CDP')
        //             ->required(),
        //         Forms\Components\Toggle::make('cadetship')
        //             ->label('Cadetship')
        //             ->required(),
        //         Forms\Components\Toggle::make('roster')
        //             ->label('Roster')
        //             ->required(),
        //         Forms\Components\Toggle::make('checked')
        //             ->label('Checked')
        //             ->required(),
        //         Forms\Components\Textarea::make('remarks')
        //             ->label('Remarks')
        //             ->maxLength(500),
        //         Forms\Components\TextInput::make('imoss_id')
        //             ->label('IMOSS ID')
        //             ->numeric(),
        //         Forms\Components\TextInput::make('imoss3_id')
        //             ->label('IMOSS3 ID')
        //             ->numeric(),
        //         Forms\Components\TextInput::make('link_cert')
        //             ->label('Link Certificate')
        //             ->numeric(),
        //         Forms\Components\TextInput::make('crewing_id')
        //             ->label('Crewing ID')
        //             ->numeric(),
        //         Forms\Components\DateTimePicker::make('date_modified')
        //             ->label('Date Modified'),
        //         Forms\Components\TextInput::make('modified_by')
        //             ->label('Modified By')
        //             ->numeric(),
        //         Forms\Components\DateTimePicker::make('sync_stamp')
        //             ->label('Sync Stamp'),
        //         Forms\Components\TextInput::make('synced_by')
        //             ->label('Synced By')
        //             ->numeric(),
        //         Forms\Components\DateTimePicker::make('date_inserted')
        //             ->label('Date Inserted'),
        //         Forms\Components\TextInput::make('inserted_by')
        //             ->label('Inserted By')
        //             ->numeric(),
        //         Forms\Components\DateTimePicker::make('date_imoss3_id_updt')
        //             ->label('Date IMOSS3 ID Updated'),
        //     ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('full_name')
                    ->label('Name (Last, First, Middle)')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('available')
                    ->label('Availability')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('rank_name')
                    ->label('Rank Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('vessel_name')
                    ->label('Vessel Name')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('primary_email')
                    ->label('Primary Email')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('primary_mobile')
                    ->label('Primary Mobile')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('last_employment_off_date')
                    ->label('Last Sign Off')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                // Add filters here, if needed
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ])
            ->defaultSort('surname', 'asc');
    }


    public static function getRelations(): array
    {
        return [
            RelationManagers\RelativesRelationManager::class,
            RelationManagers\BankAccountsRelationManager::class,
            RelationManagers\CertificationsRelationManager::class,
            RelationManagers\EmploymentHistoryRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSeafarers::route('/'),
            'create' => Pages\CreateSeafarer::route('/create'),
            'view' => Pages\ViewSeafarer::route('/{record}'),
            'edit' => Pages\EditSeafarer::route('/{record}/edit'),
        ];
    }
}
