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

class ContactsWidget extends Widget implements HasForms
{
    use InteractsWithForms;
    protected static string $view = 'livewire.contacts-widget';

    public ?array $data = [];
    
    public function mount(): void
    {
        $setting = Setting::first();
        if ($setting)
            $this->form->fill($setting->toArray());
    }
    
    public function form(Form $form): Form
    {
        $contacts = [
            'email' => 'Email',
            'whatsapp' => 'Whatsapp',
            'phone' => 'Phone'
        ];

        return $form
            ->schema([
                Repeater::make('contacts')        
                    ->hiddenLabel()
                    ->maxItems(count($contacts))
                    ->cloneable()
                    ->schema([
                        Select::make('type')
                            ->label('Tipe')
                            ->options($contacts)
                            ->required(),
                        TextInput::make('label')
                            ->required(),
                        TextInput::make('url')
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
