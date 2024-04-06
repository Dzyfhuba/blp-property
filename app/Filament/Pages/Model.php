<?php

namespace App\Filament\Pages;

use App\Algorithms\AHP;
use App\Models\Setting;
use Illuminate\Support\Facades\Route;
use App\Algorithms\Smarter;
use App\Models\Product;
use Filament\Notifications\Notification;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\Model as ModelTable;
use Illuminate\Support\Facades\Cache;

class Model extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.model';

    protected $model = [];

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

    function generateModel()
    {
        // $ahp = AHP::calculatePairwiseComparison();

        // $smarter = Smarter::generateModel($ahp['priority']->toArray());

        $this->model = $this->calculate();

        Cache::put('smarter', $this->model, now()->addHour());
    }

    function calculate()
    {
        $ahp = AHP::calculatePairwiseComparison();

        $weights = Smarter::generateWeights($ahp['priority']->toArray());

        $modelLatest = ModelTable::query()->orderBy('id', 'desc');
        return $weights->map(function ($weight) use ($ahp, $modelLatest) {
            return [
                'product_id' => $weight['product_id'],
                'batch' => ($modelLatest->count() ? $modelLatest->first()->batch : 0) + 1,
                'criterion' => $weight['criterion']->toArray(),
                'total' => $weight['criterion']->sum(),
                'pairwise_comparison_normalized' => $ahp['normalized']->toArray(),
                'pairwise_comparison_priority' => $ahp['priority']->toArray(),
                'pairwise_comparison_line_quality' => $ahp['line_quality']->toArray(),
                'pairwise_comparison_consistency_ratio' => $ahp['consistency_ratio'],
            ];
        });
    }

    function saveModel()
    {
        $model = Cache::get('model', $this->calculate());
        // $model = $this->calculate();

        foreach ($model as $item) {
            ModelTable::create($item);
        }

        Notification::make()
            ->title('A New Model Saved')
            ->success()
            ->send();

        $this->dispatch('close-modal', id: 'model');
    }

    function getBatch()
    {
        return request()->query('batch', request()->query('batch', Setting::first()->batch));
    }

    function getActiveBatch()
    {
        return Setting::first()->batch;
    }

    function getAllBatchs()
    {
        return ModelTable::query()->distinct('batch')->pluck('batch');
    }

    function getPreviousBatch()
    {
        return ModelTable::query()->where('batch', self::getBatch()-1)->count() ? self::getBatch()-1 : null;
    }

    function getNextBatch()
    {
        return ModelTable::query()->where('batch', self::getBatch()+1)->count() ? self::getBatch()+1 : null;
    }

    function getLimitBatch()
    {
        $query = ModelTable::query();
        return [
            'max' => $query->orderBy('id', 'desc')->first()->batch,
            'min' => $query->orderBy('id', 'asc')->first()->batch,
        ];
    }
}
