<?php

namespace Database\Seeders;

use App\Models\Activity;
use App\Models\Lead;
use App\Models\User;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $leads = Lead::all();

        foreach ($leads as $lead) {
            Activity::factory()
                ->count(rand(2, 4))
                ->create([
                    'lead_id' => $lead->id,
                    'assigned_to_user_id' => $users->random()->id,
                ]);
        }
    }
}
