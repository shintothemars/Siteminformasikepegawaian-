<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\PengalamanKerja;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengalamanKerja>
 */
class PengalamanKerjaFactory extends Factory
{
    protected $model = PengalamanKerja::class;

    public function definition(): array
    {
        return [
            'karyawan_id' => Karyawan::factory(),
            'nama_perusahaan' => $this->faker->company,
            'jabatan' => $this->faker->jobTitle,
            'mulai_bulan' => $this->faker->monthName,
            'mulai_tahun' => $this->faker->year,
            'sampai_bulan' => $this->faker->monthName,
            'sampai_tahun' => $this->faker->year,
            'gaji' => $this->faker->numberBetween(3000000, 10000000),
            'alasan_keluar' => $this->faker->sentence(3),
        ];
    }
}
