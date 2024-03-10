<?php

namespace App\Filament\Resources\LocationOptionResource\Pages;

use App\Filament\Resources\LocationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocationOption extends EditRecord
{
    protected static string $resource = LocationOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
