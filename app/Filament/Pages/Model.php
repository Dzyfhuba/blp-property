<?php

namespace App\Filament\Pages;

use App\Algorithms\AHP;
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
        $ahp = AHP::calculatePairwiseComparison();

        dd($ahp);

        $model = Smarter::generateModel();

        $this->model = $model;

        Cache::put('model', $model, now()->addHour());
    }

    function saveModel()
    {
        $model = Cache::get('model', Smarter::generateModel());

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
        return request()->query('batch', ModelTable::query()->orderBy('id', 'desc')->first()->batch);
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
