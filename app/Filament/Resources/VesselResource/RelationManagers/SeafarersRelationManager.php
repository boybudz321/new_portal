<?php

namespace App\Filament\Resources\VesselResource\RelationManagers;

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

    protected static ?string $title = 'Vessel Seafarers';

    protected static ?string $recordTitleAttribute = 'full_name';

    protected static ?string $modelLabel = 'seafarer';

    public function table(Table $table): Table
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
                    ->searchable(['LName', 'FName', 'MName'])
                    ->sortable()
                    ->placeholder('N/A')
                    ->weight('bold'),

                Tables\Columns\TextColumn::make('available')
                    ->label('Availability')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'Available' => 'success',
                        'Not Available' => 'danger',
                        default => 'warning',
                    }),

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
                    ->placeholder('N/A')
                    ->copyable()
                    ->icon('heroicon-m-envelope'),

                Tables\Columns\TextColumn::make('primary_mobile')
                    ->label('Primary Mobile')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A')
                    ->copyable()
                    ->icon('heroicon-m-phone'),

                Tables\Columns\TextColumn::make('last_employment_off_date')
                    ->label('Last Sign Off')
                    ->date('M d, Y')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                // Tables\Filters\SelectFilter::make('available')
                //     ->options([
                //         'Available' => 'Available',
                //         'Not Available' => 'Not Available',
                //     ]),
                // Tables\Filters\SelectFilter::make('rank_name')
                //     ->label('Rank')
                //     ->relationship('rank', 'name'),
            ])
            ->defaultSort('last_employment_off_date', 'desc')
            ->headerActions([
                // Tables\Actions\AttachAction::make()
                //     ->preloadRecordSelect()
                //     ->recordSelectSearchColumns(['surname', 'name', 'middle_name']),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DetachBulkAction::make(),
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->emptyStateHeading('No seafarers attached')
            ->emptyStateDescription('Start by attaching seafarers to this vessel.')
            ->emptyStateIcon('heroicon-o-user-group');
    }
}
