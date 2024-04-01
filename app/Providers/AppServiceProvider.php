<?php

namespace App\Providers;

use Filament\Http\Responses\Auth\LogoutResponse;
use Filament\Support\Assets\Css;
use Filament\Support\Assets\Js;
use Filament\Support\Facades\FilamentAsset;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(LogoutResponse::class, \App\Http\Responses\LogoutResponse::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        FilamentAsset::register([
            // Js::make('pairwise-comparison', resource_path('js/filament/pairwise-comparison.js'))->loadedOnRequest(),
            Js::make('tailwindcss', 'https://cdn.tailwindcss.com'),
            Css::make('tailwindcss', resource_path('css/custom-filament.css')),
        ]);
    }
}
