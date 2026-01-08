<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ActivityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'subject' => $this->faker->sentence(4),
            'type' => $this->faker->randomElement(['call', 'meeting', 'email']),
            'status' => $this->faker->randomElement(['scheduled', 'completed', 'cancelled']),
            'scheduled_at' => $this->faker->dateTimeBetween('-7 days', '+7 days'),
            'duration_minutes' => $this->faker->numberBetween(10, 120),
            'description' => $this->faker->paragraph(),
        ];
    }
}
