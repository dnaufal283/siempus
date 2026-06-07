<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminitSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin IT',
            'email' => 'adminit@siempus.com', // Sesuaikan email loginmu
            'password' => Hash::make('password123'), // Sesuaikan password-mu
            'role' => 'admin_it', // Sesuaikan dengan nama role di database-mu
        ]);
    }
}