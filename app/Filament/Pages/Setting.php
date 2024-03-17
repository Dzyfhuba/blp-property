<?php

namespace App\Filament\Pages;

use App\Livewire\ContactsWidget;
use App\Livewire\MarketingExecutivesWidget;
use App\Livewire\SettingOthersWidget;
use App\Livewire\WeightProductCriterionWidget;
use Filament\Pages\Page;

class Setting extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament.pages.setting';

    protected static ?int $navigationSort = 99;

    protected function getHeaderWidgets(): array
    {
        return [
            ContactsWidget::class,
            MarketingExecutivesWidget::class,
            WeightProductCriterionWidget::class,
            SettingOthersWidget::class,
        ];
    }
}