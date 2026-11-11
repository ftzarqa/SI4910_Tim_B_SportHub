<?php

namespace Database\Seeders;

use App\Models\AlatOlahraga;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Akun Default Pengguna & Administrator
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

        // 2. Data Awal Katalog Alat Olahraga
        AlatOlahraga::create([
            'nama_alat'  => 'Raket Badminton Yonex Nanoray',
            'kategori'   => 'Bulu Tangkis',
            'kondisi'    => 'Sangat Baik',
            'tarif_sewa' => 25000,
            'stok'       => 8,
        ]);

        AlatOlahraga::create([
            'nama_alat'  => 'Bola Basket Molten GG7X',
            'kategori'   => 'Bola Basket',
            'kondisi'    => 'Baik',
            'tarif_sewa' => 20000,
            'stok'       => 5,
        ]);

        AlatOlahraga::create([
            'nama_alat'  => 'Bola Futsal Specs Elysium',
            'kategori'   => 'Sepak Bola & Futsal',
            'kondisi'    => 'Baru',
            'tarif_sewa' => 20000,
            'stok'       => 6,
        ]);
    }
}
