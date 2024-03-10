<?php

namespace App\Filament\Resources\LocationOptionResource\Pages;

use App\Filament\Resources\LocationOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocationOptions extends ListRecords
{
    protected static string $resource = LocationOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
