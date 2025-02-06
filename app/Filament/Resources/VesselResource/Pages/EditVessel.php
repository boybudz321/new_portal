<?php

namespace App\Filament\Resources\VesselResource\Pages;

use App\Filament\Resources\VesselResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditVessel extends EditRecord
{
    protected static string $resource = VesselResource::class;

    // protected function mutateFormDataBeforeFill(array $data): array
    // {
    //     dd( $data);
    //     if($this->isArrayOrNullOrEmpty($this->data['photo_directory']))
    //     {
    //         $data['photo_directory'] = '';
    //     }
    //     if($this->isArrayOrNullOrEmpty($this->data['avatar']))
    //     {
    //         $data['avatar'] = '';
    //     }
    //     if($this->isArrayOrNullOrEmpty($this->data['risk_attachment']))
    //     {
    //         $data['risk_attachment'] = '';
    //     }
    //     return $data;
    // }

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
