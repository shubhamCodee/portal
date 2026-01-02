<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Lead>
 */
class LeadFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),

            'email' => $this->faker->optional()->safeEmail(),

            'phone' => $this->faker->optional()->phoneNumber(),

            'status' => $this->faker->randomElement([
                'new',
                'contacted',
                'qualified',
                'converted',
                'lost',
            ]),

            'source' => $this->faker->optional()->randomElement([
                'website',
                'referral',
                'cold-call',
                'ads',
            ]),

            'tags' => $this->faker->optional()->randomElements(
                ['hot', 'enterprise', 'follow-up'],
                rand(1, 3)
            ),

            'follow_up_date' => $this->faker->optional()->dateTimeBetween('now', '+15 days'),

            'follow_up_time' => $this->faker->optional()->time(),

            'meeting_at' => $this->faker->optional()->dateTimeBetween('-5 days', '+10 days'),

            'notes' => $this->faker->optional()->sentence(10),

            'is_active' => $this->faker->boolean(80),
        ];
    }
}
