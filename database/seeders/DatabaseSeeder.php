<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create fixed admin
        User::factory()->admin()->create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
        ]);

        // Create fixed manager
        $manager = User::factory()->manager()->create([
            'name' => 'Manager User',
            'email' => 'manager@example.com',
        ]);

        // Create fixed employee
        User::factory()->employee()->create([
            'name' => 'Employee User',
            'email' => 'employee@example.com',
        ]);

        // Create departments and assign the fixed manager
        $departments = Department::factory()->count(4)->create([
            'manager_id' => $manager->id,
        ]);

        // Create extra managers, each assigned to a department
        $departments->each(function ($department) {
            $extraManager = User::factory()->manager()->create([
                'department_id' => $department->id,
            ]);
            $department->update(['manager_id' => $extraManager->id]);
        });

        // Create random employees spread across departments
        User::factory()->count(10)->employee()->create([
            'department_id' => fn() => $departments->random()->id,
        ]);
    }
}
