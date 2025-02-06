<?php

namespace App\Filament\Resources\UniformDataResource\Pages;

use App\Filament\Resources\UniformDataResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListUniformData extends ListRecords
{
    protected static string $resource = UniformDataResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // Actions\CreateAction::make(),
        ];
    }
}
