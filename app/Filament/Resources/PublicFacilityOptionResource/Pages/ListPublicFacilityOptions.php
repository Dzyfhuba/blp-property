<?php

namespace App\Filament\Resources\PublicFacilityOptionResource\Pages;

use App\Filament\Resources\PublicFacilityOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPublicFacilityOptions extends ListRecords
{
    protected static string $resource = PublicFacilityOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
