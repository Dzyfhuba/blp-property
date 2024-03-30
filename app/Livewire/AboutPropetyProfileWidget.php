<?php

namespace App\Livewire;

use App\Models\About;
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
        $about = About::first();
        if ($about)
            $this->form->fill($about->toArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('title')->label('Title'),
                TextInput::make('content')->label('Content'),
                FileUpload::make('image')->label('Upload Image')
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif']) // Tipe file yang diizinkan
                    ->rules('image|max:1024'),
            ])
            ->statePath('data');
    }


    public function submit(): void
    {
        About::updateOrCreate([
            'id' => 1,
            'title'=> 'title',
            'content'=> 'content',
            'image'=> 'image',
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
