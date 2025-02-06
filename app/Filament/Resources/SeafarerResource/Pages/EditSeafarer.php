<?php

namespace App\Filament\Resources\SeafarerResource\Pages;

use App\Filament\Resources\SeafarerResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSeafarer extends EditRecord
{
    protected static string $resource = SeafarerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
