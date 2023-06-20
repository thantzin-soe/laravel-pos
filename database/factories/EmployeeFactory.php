<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
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
            'email' => $this->faker->unique()->email(),
            'experience' => $this->faker->numberBetween(1, 5),
            'phone' => $this->faker->unique()->phoneNumber(),
            'address' => $this->faker->unique()->streetAddress(),
            'salary' => $this->faker->numberBetween(10000, 300000),
            'vacation' => $this->faker->numberBetween(1, 5),
            'city' => $this->faker->city()
        ];
    }
}
