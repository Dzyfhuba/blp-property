<?php

namespace App\Livewire;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;


class AboutPropetyProfileWidget extends Widget implements HasForms
{
    use InteractsWithForms;

    protected static string $view = "livewire.about-propety-profile-widget";

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
        return $form
            ->schema([
                TextInput::make('title')->label('Title'),
                TextInput::make('description')->label('Description'),
                FileUpload::make('gambar')->label('Upload Gambar')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']) // Tipe file yang diizinkan
                    ->rules('image|max:1024'),
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
