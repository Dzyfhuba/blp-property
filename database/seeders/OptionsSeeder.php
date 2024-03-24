<?php

namespace Database\Seeders;

use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\PublicFacilityOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OptionsSeeder extends Seeder
{
    public function facilites()
    {
        $data = [
            ['label' => 'Lengkap', 'value' => 3],
            ['label' => 'Cukup', 'value' => 2],
            ['label' => 'Kurang', 'value' => 1],
        ];

        foreach ($data as $item) {
            FacilityOption::create($item);
        }
    }

    public function publicFacilities()
    {
        $data = [
            ['label' => 'Lengkap', 'value' => 3],
            ['label' => 'Cukup', 'value' => 2],
            ['label' => 'Kurang', 'value' => 1],
        ];

        foreach ($data as $item) {
            PublicFacilityOption::create($item);
        }
    }

    public function locations()
    {
        $data = [
            ['label' => 'Kurang dari 2 km dari keramaian', 'value' => 3],
            ['label' => 'Antara 2 hingga 5 km dari keramaian', 'value' => 2],
            ['label' => 'Lebih dari 5 km dari keramaian', 'value' => 1],
        ];

        foreach ($data as $item) {
            LocationOption::create($item);
        }
    }

    public function designs()
    {
        $data = [
            ['label' => 'Mewah', 'value' => 3],
            ['label' => 'Minimalis', 'value' => 2],
            ['label' => 'Biasa', 'value' => 1],
        ];

        foreach ($data as $item) {
            DesignOption::create($item);
        }
    }

    public function run(): void
    {
        $this->facilites();
        $this->publicFacilities();
        $this->locations();
        $this->designs();
    }
}
