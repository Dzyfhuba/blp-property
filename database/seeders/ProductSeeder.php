<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Type Tokyo',
                'description' => '',
                'category_id' => 1,
                'price' => 350,
                'bedrooms' => 3,
                'bathrooms' => 2,
                'land_size' => 105,
                'facility_option_id' => 1,
                'public_facility_option_id' => 1,
                'design_option_id' => 1,
                'location_option_id' => 1,
                'floors' => 2,
                'building_size' => 70,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Osaka',
                'description' => '',
                'category_id' => 1,
                'price' => 280,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'land_size' => 65,
                'facility_option_id' => 1,
                'public_facility_option_id' => 1,
                'design_option_id' => 2,
                'location_option_id' => 1,
                'floors' => 1,
                'building_size' => 40,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Kyoto',
                'description' => '',
                'category_id' => 1,
                'price' => 250,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'land_size' => 65,
                'facility_option_id' => 2,
                'public_facility_option_id' => 1,
                'design_option_id' => 3,
                'location_option_id' => 1,
                'floors' => 1,
                'building_size' => 30,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Winner',
                'description' => '',
                'category_id' => 2,
                'price' => 500,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'land_size' => 90,
                'facility_option_id' => 1,
                'public_facility_option_id' => 2,
                'design_option_id' => 1,
                'location_option_id' => 2,
                'floors' => 1,
                'building_size' => 45,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Sporty',
                'description' => '',
                'category_id' => 2,
                'price' => 350,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'land_size' => 65,
                'facility_option_id' => 2,
                'public_facility_option_id' => 2,
                'design_option_id' => 2,
                'location_option_id' => 2,
                'floors' => 1,
                'building_size' => 30,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Orchard',
                'description' => '',
                'category_id' => 3,
                'price' => 800,
                'bedrooms' => 2,
                'bathrooms' => 2,
                'land_size' => 119,
                'facility_option_id' => 1,
                'public_facility_option_id' => 1,
                'design_option_id' => 1,
                'location_option_id' => 1,
                'floors' => 2,
                'building_size' => 72,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Cliff',
                'description' => '',
                'category_id' => 4,
                'price' => 600,
                'bedrooms' => 1,
                'bathrooms' => 2,
                'land_size' => 65,
                'facility_option_id' => 1,
                'public_facility_option_id' => 2,
                'design_option_id' => 1,
                'location_option_id' => 1,
                'floors' => 2,
                'building_size' => 72,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Highland',
                'description' => '',
                'category_id' => 4,
                'price' => 500,
                'bedrooms' => 1,
                'bathrooms' => 1,
                'land_size' => 78,
                'facility_option_id' => 2,
                'public_facility_option_id' => 2,
                'design_option_id' => 2,
                'location_option_id' => 1,
                'floors' => 1,
                'building_size' => 40,
                'capacity' => 0,
                'occupied' => 0,
            ],
            [
                'name' => 'Type Hilltop',
                'description' => '',
                'category_id' => 4,
                'price' => 450,
                'bedrooms' => 2,
                'bathrooms' => 1,
                'land_size' => 90,
                'facility_option_id' => 1,
                'public_facility_option_id' => 1,
                'design_option_id' => 2,
                'location_option_id' => 1,
                'floors' => 1,
                'building_size' => 50,
                'capacity' => 0,
                'occupied' => 0,
            ],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
