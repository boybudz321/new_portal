<?php

namespace App\Filament\Resources\PrincipalResource\RelationManagers;

use App\Filament\Resources\VesselResource;
use App\Models\Principal;
use App\Models\Vessel;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class VesselsRelationManager extends RelationManager
{
    protected static string $relationship = 'vessels';

    // public function form(Form $form): Form
    // {
    //     return $form
    //         ->schema([
    //             Forms\Components\Hidden::make('PrinCode')
    //                 ->default(fn($livewire) => $livewire->ownerRecord->PrinCode),
    //             Forms\Components\TextInput::make('VslCode')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('Name')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('VslTypeCode')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('OffNbr')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('PortofReg')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('Classf')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('YearBuilt')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('GrossTon')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('DeadWt')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('NetTon')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('EngType')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('EngPower')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\TextInput::make('OwnerCode')
    //                 ->required()
    //                 ->maxLength(100),
    //             Forms\Components\Toggle::make('ActCode')
    //                 ->required(),
    //             Forms\Components\TextInput::make('photo_directory')
    //                 ->maxLength(200),
    //             Forms\Components\TextInput::make('flag2')
    //                 ->maxLength(50),
    //             Forms\Components\DateTimePicker::make('date_modified'),
    //             Forms\Components\TextInput::make('modified_by')
    //                 ->numeric(),
    //             Forms\Components\DateTimePicker::make('sync_stamp'),
    //             Forms\Components\TextInput::make('synced_by')
    //                 ->numeric(),
    //             Forms\Components\DateTimePicker::make('date_inserted'),
    //             Forms\Components\TextInput::make('inserted_by')
    //                 ->numeric(),
    //             Forms\Components\TextInput::make('risk_profile')
    //                 ->numeric(),
    //             Forms\Components\DatePicker::make('risk_date'),
    //             Forms\Components\TextInput::make('risk_attachment')
    //                 ->maxLength(500),
    //             Forms\Components\TextInput::make('ship_size')
    //                 ->maxLength(20),
    //             Forms\Components\TextInput::make('right_ship')
    //                 ->maxLength(15),
    //             Forms\Components\TextInput::make('emission_rate')
    //                 ->maxLength(15),
    //         ]);
    // }

    public function table(Table $table): Table
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
            ->headerActions([
                Tables\Actions\CreateAction::make(),
                Tables\Actions\AttachAction::make()
                    ->form(
                        fn(Form $form): Form => $form
                            ->schema([
                                Forms\Components\Select::make('vessel_id')
                                    ->label('Vessel')
                                    ->options(
                                        Vessel::whereNull('PrinCode') // Only unassigned vessels
                                            ->pluck('Name', 'VslCode')
                                    )
                                    ->searchable()
                                    ->required()
                            ])
                    )
                    ->action(function (Principal $record, array $data): void {
                        Vessel::where('VslCode', $data['vessel_id'])
                            ->update(['PrinCode' => $record->PrinCode]);
                    })
            ])
            ->actions([
                Tables\Actions\ViewAction::make()->url(fn($record) => VesselResource::getUrl('view', ['record' => $record])),
                Tables\Actions\EditAction::make(),
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
