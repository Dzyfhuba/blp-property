<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'Permata Natura',
                'status' => 'complete',
            ],
            [
                'name' => 'Permata Sportivo',
                'status' => 'complete',
            ],
            [
                'name' => 'Permata Orchard',
                'status' => 'progress',
            ],
            [
                'name' => 'Permata Discovery',
                'status' => 'progress',
            ],
        ];

        foreach ($data as $item) {
            Category::create($item);
        }
    }
}
