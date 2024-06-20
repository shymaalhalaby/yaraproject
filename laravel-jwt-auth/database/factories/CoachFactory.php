<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coach>
 */
class CoachFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'), // You can use bcrypt or any other hashing technique
            'WorkHours' => $this->faker->numberBetween(1, 8),
            'ProfileImage' => null,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone_number' => $this->faker->numerify('##########'), // Generates a 10-digit number
            'Age' => $this->faker->numberBetween(18, 60),
            'user_id' => \App\Models\User::factory(), // Assuming you have a User model and its factory
        ];
    }
}
