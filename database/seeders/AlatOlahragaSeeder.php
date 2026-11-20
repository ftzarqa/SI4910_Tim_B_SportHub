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
        AlatOlahraga::updateOrCreate(
            ['nama_alat' => 'Raket Badminton Yonex Nanoray'],
            [
                'kategori'   => 'Bulu Tangkis',
                'kondisi'    => 'Sangat Baik',
                'tarif_sewa' => 25000,
                'stok'       => 8,
                'gambar'     => 'images/alat/raket-badminton.svg',
            ]
        );

        AlatOlahraga::updateOrCreate(
            ['nama_alat' => 'Bola Basket Molten GG7X'],
            [
                'kategori'   => 'Bola Basket',
                'kondisi'    => 'Baik',
                'tarif_sewa' => 20000,
                'stok'       => 5,
                'gambar'     => 'images/alat/bola-basket.svg',
            ]
        );

        AlatOlahraga::updateOrCreate(
            ['nama_alat' => 'Bola Futsal Specs Elysium'],
            [
                'kategori'   => 'Sepak Bola & Futsal',
                'kondisi'    => 'Baru',
                'tarif_sewa' => 20000,
                'stok'       => 6,
                'gambar'     => 'images/alat/bola-futsal.svg',
            ]
        );
    }
}
