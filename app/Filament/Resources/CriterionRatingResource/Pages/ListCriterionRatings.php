<?php

namespace App\Filament\Resources\CriterionRatingResource\Pages;

use App\Filament\Resources\CriterionRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListCriterionRatings extends ListRecords
{
    protected static string $resource = CriterionRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
