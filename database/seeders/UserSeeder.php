<?php

namespace Database\Seeders;

use App\Models\DesignOption;
use App\Models\FacilityOption;
use App\Models\LocationOption;
use App\Models\PublicFacilityOption;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
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

        $admin = User::create([
            'name' => 'Admin 1',
            'email' => 'admin@mail.com',
            'password' => Hash::make('12345678')
        ]);
        $admin->assignRole('user');
        $user = User::create([
            'name' => 'User 1',
            'email' => 'user@mail.com',
            'password' => Hash::make('12345678')
        ]);
        $user->assignRole('user');
    }
}
