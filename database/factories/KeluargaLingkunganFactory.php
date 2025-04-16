<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\KeluargaLingkungan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\KeluargaLingkungan>
 */
class KeluargaLingkunganFactory extends Factory
{
    protected $model = KeluargaLingkungan::class;

    public function definition(): array
    {
        return [
            'karyawan_id' => Karyawan::factory(),
            'hubungan' => $this->faker->randomElement(['ayah', 'ibu', 'saudara', 'suami/istri', 'anak']),
            'nama' => $this->faker->name(),
            'jenis_kelamin' => $this->faker->randomElement(['L', 'P']),
            'umur' => $this->faker->numberBetween(5, 80),
            'pendidikan' => $this->faker->randomElement(['SD', 'SMP', 'SMA', 'S1', 'S2']),
            'alamat' => $this->faker->address(),
            'profesi' => $this->faker->jobTitle(),
            'telepon' => $this->faker->phoneNumber(),
        ];
    }
}
