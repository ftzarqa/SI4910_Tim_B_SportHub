<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'     => 'Administrator',
                'password' => Hash::make('admin123'),
                'role'     => 'admin',
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name'     => 'Penyewa Olahraga',
                'password' => Hash::make('user123'),
                'role'     => 'user',
            ]
        );
    }
}
