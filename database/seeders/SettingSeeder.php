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
                [
                    'criteria' => 'price',
                    'weight' => 0.127
                ],
                [
                    'criteria' => 'bedrooms',
                    'weight' => 0.106
                ],
                [
                    'criteria' => 'bathrooms',
                    'weight' => 0.048
                ],
                [
                    'criteria' => 'land_size',
                    'weight' => 0.188
                ],
                [
                    'criteria' => 'facility_option_id',
                    'weight' => 0.157
                ],
                [
                    'criteria' => 'public_facility_option_id',
                    'weight' => 0.028
                ],
                [
                    'criteria' => 'design_option_id',
                    'weight' => 0.039
                ],
                [
                    'criteria' => 'location_option_id',
                    'weight' => 0.139
                ],
                [
                    'criteria' => 'floors',
                    'weight' => 0.021
                ],
                [
                    'criteria' => 'building_size',
                    'weight' => 0.147
                ],
            ],
            'contacts' => [],
            'marketing_executives' => [],
            'social_medias' => [],
            'address' => '',
            'google_maps_url' => '',
        ]);
    }
}
