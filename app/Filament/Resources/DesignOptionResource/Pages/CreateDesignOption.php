<?php

namespace App\Filament\Resources\DesignOptionResource\Pages;

use App\Filament\Resources\DesignOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDesignOption extends CreateRecord
{
    protected static string $resource = DesignOptionResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
