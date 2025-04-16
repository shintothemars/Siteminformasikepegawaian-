<?php

namespace Database\Factories;

use App\Models\Karyawan;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'role' => 'user', // default user
            'password' => Hash::make('worksync'),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function (User $user) {
            $user->email = 'karyawan' . $user->id . '@worksync.com';
            $user->save();

            if ($user->role === 'user') {
                Karyawan::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });
    }
}
