<?php

namespace App\Livewire;

use App\Models\Setting;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;

class MarketingExecutivesWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = 'livewire.marketing-executives-widget';

    public ?array $data = [];

    public function mount(): void
    {
        $setting = Setting::first();
        if ($setting)
            $this->form->fill($setting->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Repeater::make('marketing_executives')
                    ->hiddenLabel()
                    ->cloneable()
                    ->schema([
                        TextInput::make('name')
                            ->required(),
                        TextInput::make('phone')
                            ->tel()
                            ->required(),
                    ])
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
}
