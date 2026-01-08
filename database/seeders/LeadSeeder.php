<?php

namespace Database\Seeders;

use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Lead::factory()
                ->count(rand(6, 12))
                ->create([
                    'assigned_to_user_id' => $user->id,
                ]);
        }
    }
}
