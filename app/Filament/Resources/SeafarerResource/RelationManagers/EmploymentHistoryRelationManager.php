<?php

namespace App\Filament\Resources\SeafarerResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Illuminate\Support\Carbon;
use App\Models\EmploymentHistory;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Wizard\Step;
use Filament\Forms\Components\MarkdownEditor;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use App\Forms\Components\SeafarerEmployeeHistoryContractSection1;
use App\Forms\Components\SeafarerEmployeeHistoryContractSection2;
use App\Forms\Components\SeafarerEmployeeHistoryContractSection3;
use App\Forms\Components\SeafarerEmployeeHistoryContractSection4;
use App\Forms\Components\SeafarerEmployeeHistoryContractSection5;

class EmploymentHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'employmentHistory';

    public static ?string $navigationLabel = 'Employment History';

    public static ?string $title = 'Sea Service';

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
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

                Tables\Columns\TextColumn::make('vessel_type_name')
                    ->label('Vessel Type')
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('on_date')
                    ->label('Sign On')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('off_date')
                    ->label('Sign Off')
                    ->date()
                    ->searchable()
                    ->sortable()
                    ->placeholder('N/A'),

                Tables\Columns\TextColumn::make('service_days')
                    ->label('Contract Duration')
                    ->formatStateUsing(function ($record) {
                        $days = $record->service_days;
                        $years = floor($days / 365);
                        $months = floor(($days % 365) / 30);
                        $remainingDays = $days % 365 % 30;

                        return $years ? "{$years} year/s, {$months} months, {$remainingDays} days" : "{$months} months, {$remainingDays} days";
                    })
                    ->sortable()
                    ->placeholder('N/A'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Action::make('Contract')
                ->steps([
                    Step::make('Seafarer\'s Information')
                        ->schema([
                            SeafarerEmployeeHistoryContractSection1::make()
                        ]),
                    Step::make('Employer\'s Information')
                        ->schema([
                            SeafarerEmployeeHistoryContractSection2::make()
                        ]),
                    Step::make('Terms of Employment')
                        ->schema([
                            SeafarerEmployeeHistoryContractSection3::make()
                        ]),
                    Step::make('Terms and Condition')
                        ->schema([
                            SeafarerEmployeeHistoryContractSection4::make()
                        ]),
                    Step::make('Confirmation and Acknowledgment')
                        ->schema([
                            SeafarerEmployeeHistoryContractSection5::make()
                        ]),
                    ])
                ->icon('heroicon-m-pencil-square')
                ->color(fn (EmploymentHistory $eh) => ($eh->confirmed === true) ? 'success' : 'danger')
                ->disabled(fn (EmploymentHistory $eh) => ($eh->confirmed === true) ? true : false)
                ->action(fn (EmploymentHistory $eh) => $eh->update(['confirmed' => true, 'confirmed_date' => Carbon::now()->toDateString()])),
                // Action::make('Contract')
                //     ->action(fn (EmploymentHistory $eh) => $eh->update(['confirmed' => true, 'confirmed_date' => Carbon::now()->toDateString()]))
                //     ->requiresConfirmation()
                //     ->modalHeading('Contract of Employment')
                //     ->modalDescription('Please read and accept the contract once reviewed.')
                //     ->modalContent(fn (EmploymentHistory $record): View => view(
                //         'filament.app.modals.employment_history_contract',
                //         ['record' => $record],
                //     ))
                //     ->modalSubmitActionLabel('Yes, I accept.')
                //     ->slideOver()
                //     ->modalWidth(MaxWidth::FiveExtraLarge)
                //     ->icon('heroicon-m-pencil-square')
                //     ->color(fn (EmploymentHistory $eh) => ($eh->confirmed === true) ? 'success' : 'danger')
                //     ->disabled(fn (EmploymentHistory $eh) => ($eh->confirmed === true) ? true : false)
                //     ->modalIcon('')
                // Tables\Actions\EditAction::make(),
                // Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
