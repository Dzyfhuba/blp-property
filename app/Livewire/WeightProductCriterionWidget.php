<?php

namespace App\Livewire;

use App\Models\Setting;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class WeightProductCriterionWidget extends Widget implements HasForms
{
    use InteractsWithForms;
    protected static string $view = 'livewire.weight-product-criterion-widget';
    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();
        if ($setting)
            $this->form->fill($setting->toArray());
    }

    public function form(Form $form): Form
    {
        $tableColumns = [
            'price' => 'Harga',
            'bedrooms' => 'Jumlah Kamar Tidur',
            'bathrooms' => 'Jumlah Kamar Mandi',
            'land_size' => 'Luas Tanah',
            'facility_option_id' => 'Fasilitas',
            'public_facility_option_id' => 'Fasilitas Publik',
            'design_option_id' => 'Desain',
            'location_option_id' => 'Lokasi',
            'floors' => 'Jumlah Lantai',
            'building_size' => 'Luas Bangunan',
        ];
        return $form
            ->schema([
                Section::make('Bobot setiap kriteria produk')
                    ->schema([
                        Repeater::make('weight_product_criterion')
                            ->label('Bobot Kriteria Produk')
                            ->cloneable()
                            ->columns()
                            ->maxItems(count($tableColumns))
                            ->schema([
                                Select::make('criteria')->options($tableColumns),
                                TextInput::make('weight')->label('Bobot')->numeric()
                            ])
                    ])
                    ->collapsible()
                    ->collapsed()
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
        dd($this->form->getState());
        Setting::updateOrCreate([
            'id' => 1
        ], $this->form->getState());

        $this->dispatch('close-modal', id: 'confirm');

        Notification::make()
            ->title('Saved successfully')
            ->success()
            ->send();

    }

    public function closeModal()
    {
        $this->dispatch('close-modal', id: 'confirm');
    }

    public function total()
    {
        // print_r($this->form);
    }
}
