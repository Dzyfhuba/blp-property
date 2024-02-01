<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

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
