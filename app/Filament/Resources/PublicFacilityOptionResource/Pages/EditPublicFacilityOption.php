<?php

namespace App\Filament\Resources\PublicFacilityOptionResource\Pages;

use App\Filament\Resources\PublicFacilityOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPublicFacilityOption extends EditRecord
{
    protected static string $resource = PublicFacilityOptionResource::class;

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
