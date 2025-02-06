<?php

namespace App\Filament\Resources\VesselResource\Pages;

use Filament\Actions;
use Illuminate\Database\Eloquent\Model;
use App\Filament\Resources\VesselResource;
use Filament\Resources\Pages\CreateRecord;

class CreateVessel extends CreateRecord
{
    protected static string $resource = VesselResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        //dd( $data);
        if($this->isArrayOrNullOrEmpty($this->data['photo_directory']))
        {
            $data['photo_directory'] = '';
        }
        if($this->isArrayOrNullOrEmpty($this->data['avatar']))
        {
            $data['avatar'] = '';
        }
        if($this->isArrayOrNullOrEmpty($this->data['risk_attachment']))
        {
            $data['risk_attachment'] = '';
        }
        return $data;
    }


    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    function isArrayOrNullOrEmpty($value) {
        return is_array($value) || is_null($value) || empty($value);
    }


}
