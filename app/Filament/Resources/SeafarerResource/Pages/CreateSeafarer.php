<?php

namespace App\Filament\Resources\SeafarerResource\Pages;

use App\Filament\Resources\SeafarerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSeafarer extends CreateRecord
{
    protected static string $resource = SeafarerResource::class;

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }
}
