<?php

namespace App\Filament\Resources\CriterionRatingResource\Pages;

use App\Filament\Resources\CriterionRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateCriterionRating extends CreateRecord
{
    protected static string $resource = CriterionRatingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
