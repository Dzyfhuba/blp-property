<?php

namespace App\Filament\Pages;

use App\Livewire\AboutPropetyProfileWidget;
use Filament\Pages\Page;

class About extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.about';

    // protected static ?int $navigationSort = 99;

    protected function getHeaderWidgets(): array
    {
        return [
            AboutPropetyProfileWidget::class
        ];
    }
}
