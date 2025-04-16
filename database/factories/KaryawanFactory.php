<?php

namespace Database\Factories;

use App\Models\DokumenPendukung;
use App\Models\Karyawan;
use App\Models\KeluargaLingkungan;
use App\Models\PengalamanKerja;
use App\Models\Referensi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Karyawan>
 */
class KaryawanFactory extends Factory
{
    protected $model = Karyawan::class;

    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'jabatan' => $this->faker->randomElement(['Staf', 'Supervisor', 'Manager']),
            'nama_panggilan' => $this->faker->firstName(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-20 years'),
            'golongan_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha']),
            'alamat' => $this->faker->address(),
            'no_hp' => $this->faker->phoneNumber(),
            'status' => $this->faker->randomElement(['Belum Kawin', 'Kawin']),
            'jumlah_anak' => $this->faker->numberBetween(0, 4),
            'tinggi_badan' => $this->faker->numberBetween(150, 180),
            'berat_badan' => $this->faker->numberBetween(45, 90),
            'no_ktp' => $this->faker->nik(),
            'ktp_berlaku_sampai' => $this->faker->dateTimeBetween('+1 years', '+10 years'),
            'tinggal_dengan_keluarga' => $this->faker->boolean(),
            'anak_ke' => $this->faker->numberBetween(1, 5),
            'darurat_nama' => $this->faker->name(),
            'darurat_hubungan' => $this->faker->randomElement(['Ayah', 'Ibu', 'Saudara', 'Teman']),
            'darurat_telepon' => $this->faker->phoneNumber(),
            'darurat_alamat' => $this->faker->address(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (Karyawan $karyawan) {
            KeluargaLingkungan::factory(3)->create(['karyawan_id' => $karyawan->id]);
            PengalamanKerja::factory(2)->create(['karyawan_id' => $karyawan->id]);
            Referensi::factory(2)->create(['karyawan_id' => $karyawan->id]);
            DokumenPendukung::factory(2)->create(['karyawan_id' => $karyawan->id]);
        });
    }
}
