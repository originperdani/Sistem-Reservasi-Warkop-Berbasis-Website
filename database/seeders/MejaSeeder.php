<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meja;

class MejaSeeder extends Seeder
{
    public function run(): void
    {
        // Indoor AC - Non Smoking
        Meja::create(['nama_meja' => 'Meja 1 (Indoor AC - Non Smoking)', 'kapasitas' => 4, 'status' => 'tersedia']);
        Meja::create(['nama_meja' => 'Meja 2 (Indoor AC - Non Smoking)', 'kapasitas' => 4, 'status' => 'tersedia']);
        
        // Indoor Smoking Area
        Meja::create(['nama_meja' => 'Meja 3 (Indoor Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);
        Meja::create(['nama_meja' => 'Meja 4 (Indoor Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);

        // Outdoor - Smoking Area
        Meja::create(['nama_meja' => 'Meja 5 (Outdoor - Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);
        Meja::create(['nama_meja' => 'Meja 6 (Outdoor - Smoking Area)', 'kapasitas' => 4, 'status' => 'tersedia']);
    }
}
