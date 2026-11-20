<?php

namespace Database\Seeders;

use App\Models\AlatOlahraga;
use Illuminate\Database\Seeder;

class AlatOlahragaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AlatOlahraga::firstOrCreate(
            ['nama_alat' => 'Raket Badminton Yonex Nanoray'],
            [
                'kategori'   => 'Bulu Tangkis',
                'kondisi'    => 'Sangat Baik',
                'tarif_sewa' => 25000,
                'stok'       => 8,
            ]
        );

        AlatOlahraga::firstOrCreate(
            ['nama_alat' => 'Bola Basket Molten GG7X'],
            [
                'kategori'   => 'Bola Basket',
                'kondisi'    => 'Baik',
                'tarif_sewa' => 20000,
                'stok'       => 5,
            ]
        );

        AlatOlahraga::firstOrCreate(
            ['nama_alat' => 'Bola Futsal Specs Elysium'],
            [
                'kategori'   => 'Sepak Bola & Futsal',
                'kondisi'    => 'Baru',
                'tarif_sewa' => 20000,
                'stok'       => 6,
            ]
        );
    }
}
