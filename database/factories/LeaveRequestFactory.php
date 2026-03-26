<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveRequestFactory extends Factory
{
    public function definition(): array
    {
        $start = fake()->dateTimeBetween('-3 months', '+1 month');
        $end = fake()->dateTimeBetween($start, (clone $start)->modify('+10 days'));

        return [
            'user_id' => User::where('role', 'employee')->inRandomOrder()->first()?->id,
            'type' => fake()->randomElement(['vacation', 'sick', 'personal', 'unpaid']),
            'start_date' => $start,
            'end_date' => $end,
            'status' => fake()->randomElement(['pending', 'approved', 'rejected']),
            'notes' => fake()->optional()->sentence(),
            'rejection_reason' => null,
        ];
    }
}
