<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Super Admin
        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'super_admin',
        ]);

        // Content Manager
        User::create([
            'name' => 'Content Manager',
            'email' => 'content@example.com',
            'password' => Hash::make('password'),
            'role' => 'content_manager',
        ]);

        // HR Manager
        User::create([
            'name' => 'HR Manager',
            'email' => 'hr@example.com',
            'password' => Hash::make('password'),
            'role' => 'hr_manager',
        ]);
    }
}
