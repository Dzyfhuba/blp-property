<?php

namespace App\Filament\Resources\PublicFacilityOptionResource\Pages;

use App\Filament\Resources\PublicFacilityOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePublicFacilityOption extends CreateRecord
{
    protected static string $resource = PublicFacilityOptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
