<?php

namespace App\Filament\Pages;

use App\Algorithms\Smarter;
use App\Models\Product;
use Filament\Pages\Page;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use App\Models\Model as ModelTable;

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
        $model = Smarter::generateModel();

        $this->model = $model;
    }
}
