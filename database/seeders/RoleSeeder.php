<?php

namespace Database\Seeders;

use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\PublicFacilityOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        Role::create([
            'name' => 'admin',
            'guard_name' => 'web'
        ]);
        Role::create([
            'name' => 'user',
            'guard_name' => 'web'
        ]);
    }
}
