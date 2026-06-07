<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class KepalaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        if (User::where('email', 'kepala@siempus.com')->count() == 0) {
            User::create([
                'name' => 'Dr. H. Ahmad Fauzi (Kepala)',
                'email' => 'kepala@siempus.com',
                'password' => Hash::make('kepala123'),
                'role' => 'kepala',
            ]);
        }
    }
}
