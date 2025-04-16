<?php

namespace Database\Seeders;

use App\Models\Presensi;
use Illuminate\Database\Seeder;

class PresensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jenisList = ['absensi', 'terlambat', 'keluar'];

        foreach ($jenisList as $jenis) {
            Presensi::factory()
                ->count(20)
                ->state(['jenis' => $jenis])
                ->create();
        }
    }
}
