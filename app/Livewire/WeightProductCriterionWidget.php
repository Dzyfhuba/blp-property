<?php

namespace App\Livewire;

use App\Models\Setting;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
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
        // dd($setting->toArray()['weight_product_criterion']);
        if ($setting->weight_product_criterion)
            $this->form->fill($setting->toArray());
        else {
            $data = [
                "price" => null,
                "bedrooms" => null,
                "bathrooms" => null,
                "floors" => null,
                "facility" => null,
                "public_facility" => null,
                "land_size" => null,
                "building_size" => null,
                "location" => null,
                "design" => null
            ];
            $this->form->fill([
                'weight_product_criterion' => $data
            ]);
        }
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                KeyValue::make('weight_product_criterion')
                    ->keyLabel('Criteria')
                    ->valueLabel('Weight')
                    ->addable(false)
                    ->deletable(false)
                    ->editableKeys(false)
            ])
            ->statePath('data');
    }

    public function submit(): void
    {
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
        // dd(array_values($this->form->getState()['weight_product_criterion']));
        $total = array_sum(array_values($this->form->getState()['weight_product_criterion']));
        return $total;
    }
}
