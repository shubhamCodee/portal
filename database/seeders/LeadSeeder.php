<?php

namespace Database\Seeders;

use App\Models\Lead;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LeadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Lead::factory()->count(50)->create();

        Lead::factory()->count(10)->create([
            'status' => 'qualified',
            'source' => 'ads',
        ]);

        Lead::factory()->count(10)->create([
            'status' => 'contacted',
            'source' => 'website',
        ]);

        Lead::factory()->count(5)->create([
            'status' => 'lost',
            'is_active' => false,
        ]);
    }
}
