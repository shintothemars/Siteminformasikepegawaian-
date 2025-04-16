<?php

namespace Database\Factories;

use App\Models\Presensi;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Presensi>
 */
class PresensiFactory extends Factory
{
    protected $model = Presensi::class;

    public function definition(): array
    {
        $jenis = $this->faker->randomElement(['absensi', 'terlambat', 'keluar']);

        $waktu = null;
        $waktuMulai = null;
        $waktuSelesai = null;

        if ($jenis === 'absensi') {
            // Untuk absensi biasa, hanya gunakan waktu
            $waktu = $this->faker->dateTimeBetween('-5 hours', 'now');
        } else {
            // Untuk jenis terlambat atau keluar, isi waktu_mulai dan waktu_selesai
            $waktuMulai = $this->faker->dateTimeBetween('-4 hours', '-1 hour');
            $waktuSelesai = $this->faker->dateTimeBetween($waktuMulai, '+1 hour');
        }

        return [
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id,
            'jenis' => $jenis,
            'waktu' => $waktu,
            'waktu_mulai' => $waktuMulai,
            'waktu_selesai' => $waktuSelesai,
            'alasan' => $this->faker->optional()->sentence(),
            'bukti' => $this->faker->optional()->imageUrl(),
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];
    }
}
