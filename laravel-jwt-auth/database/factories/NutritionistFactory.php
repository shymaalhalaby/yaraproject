<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Nutritionist>
 */
class NutritionistFactory extends Factory
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
            'password' => bcrypt('password'), // Consider using Hash::make() for hashing
            'WorkHours' => $this->faker->numberBetween(1, 8),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone_number' => $this->faker->numerify('##########'),
            'ProfileImage' => null,
            'Age' => $this->faker->numberBetween(25, 60),
            'user_id' => \App\Models\User::factory()->create()->id, // Create a User and get the ID
        ];

    }
}
