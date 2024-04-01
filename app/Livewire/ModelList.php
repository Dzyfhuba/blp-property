<?php

namespace App\Livewire;

use App\Models\Model;
use App\Models\Setting;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\HtmlString;

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
            ->heading("Batch: ".self::getBatch()." ".(Setting::first()->model_id == self::getBatch() ? 'Active': ''))
            ->description('Consistency Ratio: '. Model::query()->where('batch', self::getBatch())->first()->pairwise_comparison_consistency_ratio)
            ->striped()
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
        return request()->query('batch', Setting::first()->model_id);
    }
}
