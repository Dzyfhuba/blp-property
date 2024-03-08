<?php

namespace App\Filament\Resources\LocationOptionResource\Pages;

use App\Filament\Resources\LocationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateLocationOption extends CreateRecord
{
    protected static string $resource = LocationOptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
