<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run()
    {
        // Mengecek apakah admin sudah ada biar tidak double
        if (User::where('email', 'admin@siempus.com')->count() == 0) {
            User::create([
                'name' => 'Admin Loket Puskesmas',
                'email' => 'admin@siempus.com',
                'password' => Hash::make('rahasia123'), // Password admin
                'role' => 'admin', // Nah, ini kuncinya!
            ]);
        }
    }
}
