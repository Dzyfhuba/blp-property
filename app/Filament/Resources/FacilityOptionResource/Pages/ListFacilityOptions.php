<?php

namespace App\Filament\Resources\FacilityOptionResource\Pages;

use App\Filament\Resources\FacilityOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListFacilityOptions extends ListRecords
{
    protected static string $resource = FacilityOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
