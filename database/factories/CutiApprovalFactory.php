<?php

namespace Database\Factories;

use App\Models\Cuti;
use App\Models\CutiApproval;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CutiApproval>
 */
class CutiApprovalFactory extends Factory
{
    protected $model = CutiApproval::class;

    public function definition(): array
    {
        return [
            'cuti_id' => Cuti::factory(),
            'user_id' => User::factory(),
            'status' => $this->faker->randomElement(['approved', 'rejected', 'pending']),
            'catatan' => $this->faker->optional()->sentence(6),
        ];
    }
}
