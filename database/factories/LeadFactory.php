<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LeadFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->company(),
            'company_name' => $this->faker->company(),
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->safeEmail(),
            'phone' => $this->faker->numerify('##########'),
            'status' => $this->faker->randomElement(['new', 'contacted', 'qualified', 'converted']),
            'source' => $this->faker->randomElement(['website', 'referral', 'ads']),
            'department' => $this->faker->word(),
            'designation' => $this->faker->jobTitle(),
            'lead_cost' => $this->faker->randomFloat(2, 100, 1000),
            'total_lead_cost' => $this->faker->randomFloat(2, 1000, 5000),
            'currency' => 'INR',
            'percentage' => $this->faker->numberBetween(10, 90),
            'city' => $this->faker->city(),
            'address' => $this->faker->address(),
            'notes' => $this->faker->sentence(),
            'is_active' => true,
        ];
    }
}
