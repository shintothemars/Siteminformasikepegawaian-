<?php

namespace Database\Seeders;

use App\Models\Cuti;
use App\Models\CutiApproval;
use App\Models\User;
use Illuminate\Database\Seeder;

class CutiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admins = User::where('role', 'admin')->get();

        $users = User::where('role', 'user')->get();

        foreach ($users as $user) {
            $cuti = Cuti::factory()->for($user)->create();

            foreach ($admins as $admin) {
                CutiApproval::factory()->create([
                    'cuti_id' => $cuti->id,
                    'user_id' => $admin->id,
                ]);
            }
        }
    }
}
