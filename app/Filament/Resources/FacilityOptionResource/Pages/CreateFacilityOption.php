<?php

namespace App\Filament\Resources\FacilityOptionResource\Pages;

use App\Filament\Resources\FacilityOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateFacilityOption extends CreateRecord
{
    protected static string $resource = FacilityOptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
