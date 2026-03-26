<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin user
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create Manager user
        User::factory()->manager()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
        ]);

        // Create Employee user
        User::factory()->employee()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
        ]);

        // Create additional random employees
        User::factory()->count(5)->employee()->create();

        // Create additional random managers
        User::factory()->count(2)->manager()->create();
    }
}
