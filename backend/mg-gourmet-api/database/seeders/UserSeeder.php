<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        User::create([
            'name' => 'Admin MG Gourmet',
            'email' => 'admin@mggourmet.com',
            'password' => Hash::make('admin123'),
        ]);

        User::create([
            'name' => 'Demo User',
            'email' => 'demo@mggourmet.com',
            'password' => Hash::make('demo123'),
        ]);
    }
}
