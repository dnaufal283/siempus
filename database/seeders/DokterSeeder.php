<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DokterSeeder extends Seeder
{
    public function run()
    {
        if (User::where('email', 'dokter@siempus.com')->count() == 0) {
            User::create([
                'name' => 'dr. Naufal Dzaki',
                'email' => 'dokter@siempus.com',
                'password' => Hash::make('rahasia123'),
                'role' => 'dokter',
            ]);
        }
    }
}

