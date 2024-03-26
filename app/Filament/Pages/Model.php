<?php

namespace App\Filament\Pages;

use App\Algorithms\Smarter;
use App\Models\Product;
use Filament\Pages\Page;

class Model extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.model';

    function generateModel()
    {
        $products = Smarter::generateModel();

        dd($products);
    }
}
