<?php

namespace App\Filament\Resources\VesselResource\Pages;

use App\Filament\Resources\VesselResource;
use App\Models\Vessel;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;

class ViewVessel extends ViewRecord
{
    protected static string $model = Vessel::class;

    protected static string $resource = VesselResource::class;

    protected static string $view = 'filament.pages.view-vessel';

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\EditAction::make(),
    //     ];
    // }

    public ?string $activeTab = 'seafarers-onboard';

    protected $queryString = ['activeTab',];

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Vessel Information')
                    ->schema([
                        TextEntry::make('VslCode')->label('Vessel Code')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('Name')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('principal.Name')->label('Principal')
                            ->badge()
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('VslTypeCode')->label('Vessel Type')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('OffNbr')->label('Office Number')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('PortofReg')->label('Port of Registration')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('Classf')->label('Classification')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('YearBuilt')->label('Year Built')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('PrinCode')
                            ->label('Principal Code')
                            ->placeholder('N/A')->inlineLabel(true),
                    ])->columns(2)->compact(true),

                Section::make('Technical Details')
                    ->schema([
                        TextEntry::make('GrossTon')->label('Gross Tonnage')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('DeadWt')->label('Dead Weight')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('NetTon')->label('Net Tonnage')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('EngType')->label('Engine Type')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('EngPower')->label('Engine Power')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('ship_size')->label('Ship Size')
                            ->placeholder('N/A')->inlineLabel(true),
                    ])->columns(2)->compact(true),

                Section::make('Additional Information')
                    ->schema([
                        TextEntry::make('ActCode')
                            ->label('Active')
                            ->formatStateUsing(fn(bool $state): string => $state ? 'Yes' : 'No')
                            ->badge()
                            ->color(fn(bool $state): string => $state ? 'success' : 'gray')
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('risk_date')->label('Risk Date')->date()
                            ->placeholder('N/A')->inlineLabel(true),
                        TextEntry::make('risk_attachment')->label('Risk Attachment')
                            ->placeholder('N/A')->inlineLabel(true),
                        ImageEntry::make('photo_directory')
                            ->label('Vessel Photo')
                            ->visibility('public')
                            ->disk('public')
                            ->placeholder('N/A')->inlineLabel(true),
                    ])->columns(2)->compact(true),
            ]);
    }
}
