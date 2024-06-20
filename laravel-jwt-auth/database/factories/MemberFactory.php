<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Member>
 */
class MemberFactory extends Factory
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
            'password' => bcrypt('password'), // Hashing the password
            'ProfileImage' => null,
            'gender' => $this->faker->randomElement(['male', 'female']),
            'phone_number' => $this->faker->numerify('##########'),
            'Age' => $this->faker->numberBetween(18, 65),
            'illness' => $this->faker->word, // Or more specific logic if needed
            'GOAL' => $this->faker->randomElement(['Improving Cardiovascular Health', 'Building Muscle Strength', 'Weight Management']),
            'Physical_case' => $this->faker->randomElement(['good', 'average', 'poor']),
            'Hieght' => $this->faker->numberBetween(150, 200), // cm
            'Wieght' => $this->faker->numberBetween(50, 100), // kg
            'target_Wieght' => $this->faker->numberBetween(50, 100), // kg
            'AT' =>$this->faker->randomElement(['GYM', 'HOME']), // Assuming AT is a DateTime
            'user_id' => \App\Models\User::factory(), // Assuming you have a User model and its factory
        ];

    }
}
