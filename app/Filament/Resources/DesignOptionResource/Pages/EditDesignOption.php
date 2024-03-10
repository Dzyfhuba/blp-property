<?php

namespace App\Filament\Resources\DesignOptionResource\Pages;

use App\Filament\Resources\DesignOptionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditDesignOption extends EditRecord
{
    protected static string $resource = DesignOptionResource::class;

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
