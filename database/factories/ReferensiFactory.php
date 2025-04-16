<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\Referensi;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Referensi>
 */
class ReferensiFactory extends Factory
{
    protected $model = Referensi::class;

    public function definition(): array
    {
        return [
            'karyawan_id' => Karyawan::factory(),
            'nama' => $this->faker->name,
            'hubungan' => $this->faker->word,
            'jabatan' => $this->faker->jobTitle,
            'alamat' => $this->faker->address,
            'telepon' => $this->faker->phoneNumber,
            'profesi' => $this->faker->jobTitle,
        ];
    }
}
