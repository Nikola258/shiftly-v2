<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->randomElement([
                'Human Resources', 'Engineering', 'Sales', 'Marketing',
                'Finance', 'Operations', 'Customer Support', 'Design',
            ]),
            'description' => fake()->sentence(),
            'manager_id' => null, // assigned in seeder
        ];
    }
}
