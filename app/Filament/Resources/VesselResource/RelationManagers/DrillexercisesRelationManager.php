<?php

namespace App\Filament\Resources\VesselResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\ViewColumn;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;
use Joaopaulolndev\FilamentPdfViewer\Infolists\Components\PdfViewerEntry;

class DrillexercisesRelationManager extends RelationManager
{
    protected static string $relationship = 'drillexercises';

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('type')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('date')
                ->label('Date')
                ->maxDate(now())
                ->displayFormat('Y')
                ->inlineLabel(),
                Forms\Components\FileUpload::make('attachment')
                ->label('Vessel Attachment')
                ->directory('vessel-drills-exercise')
                ->acceptedFileTypes(['application/pdf'])
                ->inlineLabel(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('id')
            ->columns([
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('date'),
                // ViewColumn::make('attachment')->view('filament.tables.columns.vessel-drills-attachment')
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                \Filament\Infolists\Components\Section::make('Vessel Document')
                ->description('Vessel Document Attachment')
                ->schema([
                    TextEntry::make('type')
                        ->label('Document Type'),
                    TextEntry::make('date')
                        ->label('Date Expiration')
                        ->date(),
                ]),
                \Filament\Infolists\Components\Section::make('View Attachment')
                ->description('Vessel Document Attachment')
                ->collapsible()
                ->schema([
                    PdfViewerEntry::make('attachment')
                        //->label('View the PDF')
                        ->minHeight('40svh')
                        ->columnSpanFull()
                ]),
            ]);
    }

    public function isReadOnly(): bool
    {
        return false;
    }
}
