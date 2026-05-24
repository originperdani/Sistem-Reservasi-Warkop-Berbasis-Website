<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;
use Illuminate\Support\Facades\DB;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        // Disable foreign key checks and truncate table for clean seed
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Meja::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Indoor Non-Smoking (6 tables - Top Left)
        for ($i = 1; $i <= 6; $i++) {
            Meja::create([
                'nama_meja' => 'Meja ' . $i . ' (No Smoking)',
                'kapasitas' => 4,
                'tipe' => 'indoor',
                'sub_tipe' => 'non-smoking',
                'status' => 'tersedia'
            ]);
        }

        // 2. Indoor Smoking Area (13 tables - Central)
        for ($i = 7; $i <= 19; $i++) {
            Meja::create([
                'nama_meja' => 'Meja ' . $i . ' (Smoking)',
                'kapasitas' => 4,
                'tipe' => 'indoor',
                'sub_tipe' => 'smoking',
                'status' => 'tersedia'
            ]);
        }

        // 3. Indoor Lesehan Area (6 tables - Bottom Left)
        for ($i = 20; $i <= 25; $i++) {
            Meja::create([
                'nama_meja' => 'Lesehan ' . ($i - 19),
                'kapasitas' => 4,
                'tipe' => 'indoor',
                'sub_tipe' => 'lesehan',
                'status' => 'tersedia'
            ]);
        }

        // 4. Outdoor Area (10 tables)
        for ($i = 26; $i <= 35; $i++) {
            Meja::create([
                'nama_meja' => 'Meja Outdoor ' . ($i - 25),
                'kapasitas' => 2,
                'tipe' => 'outdoor',
                'sub_tipe' => 'smoking',
                'status' => 'tersedia'
            ]);
        }
    }
}
