<?php

namespace Database\Factories;

use App\Models\Cuti;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cuti>
 */
class CutiFactory extends Factory
{
    protected $model = Cuti::class;

    public function definition(): array
    {
        $startDate = $this->faker->dateTimeBetween('-2 months', '+1 months');
        $endDate = (clone $startDate)->modify('+' . rand(1, 5) . ' days');

        return [
            'user_id' => User::where('role', 'user')->inRandomOrder()->first()->id,
            'tanggal_mulai' => $startDate->format('Y-m-d'),
            'tanggal_selesai' => $endDate->format('Y-m-d'),
            'alasan' => $this->faker->sentence(),
        ];
    }
}
