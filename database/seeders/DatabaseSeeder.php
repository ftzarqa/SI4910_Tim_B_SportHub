<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            AlatOlahragaSeeder::class,
            // LapanganSeeder::class,    // Modul Individu A (di-uncomment saat merge)
            // MemberSeeder::class,      // Modul Individu C (di-uncomment saat merge)
            // InstrukturSeeder::class,  // Modul Individu D (di-uncomment saat merge)
        ]);
    }
}
