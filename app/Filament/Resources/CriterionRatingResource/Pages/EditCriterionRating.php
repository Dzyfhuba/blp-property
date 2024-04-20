<?php

namespace App\Filament\Resources\CriterionRatingResource\Pages;

use App\Filament\Resources\CriterionRatingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditCriterionRating extends EditRecord
{
    protected static string $resource = CriterionRatingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
