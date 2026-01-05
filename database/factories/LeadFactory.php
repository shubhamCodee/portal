<?php

namespace Database\Factories;

use App\Models\Lead;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    protected $model = Lead::class;

    public function definition(): array
    {
        return [
            // Core
            'name' => $this->faker->name(),
            'company_name' => $this->faker->company(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),

            // Contact
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->numerify('##########'),
            'website' => $this->faker->url(),

            // Status & source
            'status' => $this->faker->randomElement([
                'new',
                'contacted',
                'qualified',
                'converted',
                'lost',
            ]),
            'source' => $this->faker->randomElement([
                'website',
                'referral',
                'cold-call',
                'ads',
            ]),

            // Organization
            'department' => $this->faker->randomElement([
                'Sales',
                'Marketing',
                'Operations',
                'Finance',
                'HR',
            ]),
            'designation' => $this->faker->jobTitle(),

            // Financial
            'lead_cost' => $this->faker->randomFloat(2, 100, 5000),
            'total_lead_cost' => $this->faker->randomFloat(2, 1000, 20000),
            'currency' => 'INR',
            'percentage' => $this->faker->randomFloat(2, 1, 100),

            // Tags (always at least one)
            'tags' => $this->faker->randomElements(
                ['hot', 'enterprise', 'follow-up'],
                $this->faker->numberBetween(1, 3)
            ),

            // Dates & follow-ups (always filled)
            'follow_up_date' => $this->faker->dateTimeBetween('now', '+15 days')->format('Y-m-d'),
            'follow_up_time' => $this->faker->time('H:i'),
            'meeting_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'follow_up_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'closed_date' => $this->faker->dateTimeBetween('+1 month', '+3 months')->format('Y-m-d'),

            // Location
            'city' => $this->faker->city(),
            'address' => $this->faker->streetAddress(),

            // Notes & state
            'notes' => $this->faker->paragraph(3),
            'is_active' => true,
        ];
    }
}
