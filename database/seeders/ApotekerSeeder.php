<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ApotekerSeeder extends Seeder
{
    public function run()
    {
        if (User::where('email', 'apoteker@siempus.com')->count() == 0) {
            User::create([
                'name' => 'Apoteker Puskesmas',
                'email' => 'apoteker@siempus.com',
                'password' => Hash::make('rahasia123'),
                'role' => 'apoteker',
            ]);
        }
    }
}
