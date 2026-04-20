<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        AdminUser::create([
            'name' => 'Super Admin',
            'email' => 'admin@oceanlillytours.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'active' => true,
        ]);
    }
}
