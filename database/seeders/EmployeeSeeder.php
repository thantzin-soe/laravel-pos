<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employees = [
            ['name' => 'Marcus Rashford', 'email' => 'marcus@gmail.com', 'experience' => 2, 'phone' => '09797771910', 'address' => 'Manchester, United Kingdom', 'salary' => 250000, 'vacation' => 2, 'city' => 'Manchester']
        ];

        \App\Models\Employee::factory()->count(100000)->create();
    }
}
