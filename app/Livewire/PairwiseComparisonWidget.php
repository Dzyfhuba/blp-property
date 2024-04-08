<?php

namespace App\Livewire;

use App\Models\Setting;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Notification;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Cookie;

class PairwiseComparisonWidget extends Widget
{

    protected static string $view = 'livewire.pairwise-comparison-widget';

    protected int|string|array $columnSpan = 'full';

    public ?array $data = [];

    public $pairwiseComparison = [];

    protected $criterion = [
        'price',
        'bedrooms',
        'bathrooms',
        'floors',
        'facility',
        'public_facility',
        'land_size',
        'building_size',
        'location',
        'design',
    ];

    public function mount(): void
    {
        $setting = Setting::first();
        $pairwiseComparison = [];
        if ($setting) {
            $pairwiseComparison = json_decode(Cookie::get('pairwise_comparison', json_encode(Setting::first()->pairwise_comparison)));
        } else {

            // dd(self::fillIfSameKeyWithValue($pairwiseComparison, 1));
            // dd($pairwiseComparison);
            if ($pairwiseComparison) {
                $this->pairwiseComparison = self::fillIfSameKeyWithValue($pairwiseComparison, 1);
            } else {
                foreach ($this->criterion as $criteria1) {
                    $criterionRow = [];
                    foreach ($this->criterion as $criteria2) {
                        $criterionRow[$criteria2] = $criteria1 == $criteria2 ? 1 : 0;
                    }
                    $this->pairwiseComparison[$criteria1] = $criterionRow;
                }
            }
        }
    }

    public function keyup()
    {
        // dd($this->pairwiseComparison);
        Cookie::queue(
            'pairwise_comparison',
            json_encode($this->pairwiseComparison),
            10,
            null,
            null,
            false,
            true,
            'Strict'
        );
    }

    public function updated($property, $value)
    {
        $properties = explode('.', $property);
        $key1 = $properties[1];
        $key2 = $properties[2];
        // dd($this->pairwiseComparison->$properties[2]);
        // dd($this->pairwiseComparison[$key2][$key1]);
        if ($value > 0) {
            // $this->pairwiseComparison->$key2->$key1 = rtrim(number_format(1 / $value, 3), '.0');
            $this->pairwiseComparison[$key2][$key1] = 1 / $value;
            // $this->pairwiseComparison->$key2->$key1 = $this->findClosestInteger2($value);
        }
        // dd($this->pairwiseComparison);
        Cookie::queue(
            'pairwise_comparison',
            json_encode($this->pairwiseComparison),
            10,
            null,
            null,
            false,
            true,
            'Strict'
        );
    }

    public function isSaved()
    {
        $fromCookie = Cookie('pairwise_comparison');
        $fromDatabase = Setting::first()->pairwise_comparison;

        return $fromDatabase == $fromCookie;
    }

    public function submit()
    {
        // dd($this->pairwiseComparison);
        // dd(json_decode(Cookie::get('pairwise_comparison')));

        Setting::updateOrCreate([
            'id' => 1
        ], [
            'pairwise_comparison' => $this->pairwiseComparison
        ]);

        Notification::make()
            ->success()
            ->title('Pairwise Comparison Saving Success')
            ->send();
    }

    // Function to fill values with a specified value if key1 and key2 are the same
    static function fillIfSameKeyWithValue($arrayDoubleDimension, int $desiredValue)
    {
        foreach ($arrayDoubleDimension as $key1 => $sub) {
            foreach ($sub as $key2 => $value) {
                if ($key1 == $key2) {
                    // dd($arrayDoubleDimension->$key1->$key2);
                    $arrayDoubleDimension->$key1->$key2 = $desiredValue;
                }
                ;
            }
        }

        return $arrayDoubleDimension;
    }

    function findClosestInteger2(float $value): int
    {
        $closerInteger = round($value);

        if ($value != $closerInteger) {
            $distanceToCeiling = $value - $closerInteger;
            $distanceToFloor = $closerInteger - $value;
            $closerInteger += $distanceToCeiling < $distanceToFloor ? 1 : -1;
        }

        return $closerInteger;
    }

}
