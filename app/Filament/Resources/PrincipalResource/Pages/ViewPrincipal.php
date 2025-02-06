<?php

namespace App\Filament\Resources\PrincipalResource\Pages;

use App\Filament\Resources\PrincipalResource;
use App\Models\Principal;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;

class ViewPrincipal extends ViewRecord
{
    protected static string $model = Principal::class;

    protected static string $resource = PrincipalResource::class;

    protected static string $view = 'filament.pages.view-principal';

    public ?string $activeTab = 'profile';

    protected $queryString = [
        'activeTab',
    ];

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Principal Details')
                    ->schema([
                        TextEntry::make('user.name')
                            ->label('User')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('PrinCode')
                            ->label('Principal Code')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000)
                            ->badge()
                            ->color('success'),
                        TextEntry::make('Name')
                            ->label('Name')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('Addr')
                            ->label('Address')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('CntryCode')
                            ->label('Country Code')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('Phone')
                            ->label('Phone')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('Telefax')
                            ->label('Telefax')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('Email')
                            ->label('Email')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                        TextEntry::make('ActCode')
                            ->label('Active')
                            ->placeholder('N/A')
                            ->weight(FontWeight::Bold)
                            ->copyable()
                            ->copyMessage('Copied!')
                            ->copyMessageDuration(1000),
                    ])
                    ->columns(2)->compact(),
            ])->inlineLabel();
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
