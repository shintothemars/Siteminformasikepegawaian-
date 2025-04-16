<?php

namespace Database\Factories;

use App\Models\DokumenPendukung;
use App\Models\Karyawan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DokumenPendukung>
 */
class DokumenPendukungFactory extends Factory
{
    protected $model = DokumenPendukung::class;

    public function definition(): array
    {
        return [
            'karyawan_id' => Karyawan::factory(),
            'nama_dokumen' => $this->faker->word . '.pdf',
            'file_path' => 'dokumen/' . $this->faker->uuid . '.pdf',
        ];
    }
}
