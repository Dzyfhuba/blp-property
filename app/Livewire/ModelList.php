<?php

namespace App\Livewire;

use App\Models\Model;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ModelList extends BaseWidget
{
    public function table(Table $table): Table
    {
        return $table
            ->query(
                Model::query()
            )
            ->columns([
                // ...
            ]);
    }
}
