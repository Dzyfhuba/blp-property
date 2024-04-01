<?php

namespace App\Livewire;

use App\Models\Model;
use App\Models\Setting;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\HtmlString;

class SettingOthersWidget extends Widget implements HasForms
{
    use InteractsWithForms;
    protected static string $view = 'livewire.setting-others-widget';

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
                Select::make('model_id')
                    ->label('Model')
                    ->options(Model::query()->where('pairwise_comparison_consistency_ratio', '<', 0.1)->distinct('batch')->pluck('batch', 'batch'))
                    ->suffix(new HtmlString("<a href='".route('filament.admin.pages.model')."' target='_blank'>Check</a>")),
                KeyValue::make('social_medias')
                    ->keyLabel('Social Media')
                    ->valueLabel('URL'),
                Grid::make([
                    'default' => 1,
                    'sm' => 2,
                ])
                    ->schema([
                        TextInput::make('address')
                            ->columnSpan(1),
                        TextInput::make('google_maps_url')
                            ->columnSpan(1)
                            ->url()
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
