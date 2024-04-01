<?php

namespace App\Livewire;

use App\Models\Model;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Contracts\Support\Htmlable;

class ModelList extends BaseWidget
{
    protected $criterion = [
        'price',
        'bedrooms',
        'bathrooms',
        'floors',
        'facility',
        'public_facility',
        'land_size',
        'building_size',
        'location',
        'design',
    ];

    public function table(Table $table): Table
    {
        return $table
            ->query(
                Model::query()->where('batch', self::getBatch())
            )
            ->columns([
                TextColumn::make('product.name'),
                TextColumn::make('total')->numeric(3),
            ])
            ->heading("Batch: ".self::getBatch()." ")
            ->actions([
                Action::make('Show')
                ->modalHeading('Calculation Detail')
                    ->slideOver()
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close')
                    ->modalContent(
                        fn($record) =>
                        view(
                            'livewire.model-show',
                            [
                                'criterion' => $this->criterion,
                                'model' => $record,
                            ]
                        )
                    )
            ])
            ->paginated(false);
    }

    static function getBatch()
    {
        return request()->query('batch', Model::query()->orderBy('id', 'desc')->first()->batch);
    }
}
