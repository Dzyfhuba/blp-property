<?php

namespace App\Filament\Resources\DesignOptionResource\Pages;

use App\Filament\Resources\DesignOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListDesignOptions extends ListRecords
{
    protected static string $resource = DesignOptionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
