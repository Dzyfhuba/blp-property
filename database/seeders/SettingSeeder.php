<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Setting::create([
            'weight_product_criterion' => [
                'price' => 0.127,
                'bedrooms' => 0.106,
                'bathrooms' => 0.048,
                'land_size' => 0.188,
                'facility_option_id' => 0.157,
                'public_facility_option_id' => 0.028,
                'design_option_id' => 0.039,
                'location_option_id' => 0.139,
                'floors' => 0.021,
                'building_size' => 0.147,
            ],
            'contacts' => [],
            'marketing_executives' => [],
            'social_medias' => [],
            'address' => '',
            'google_maps_url' => '',
        ]);
    }
}
