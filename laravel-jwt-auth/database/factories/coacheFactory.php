<?php

namespace Database\Factories;

use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class coacheFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email'=> fake()->email(),
           
            'WorkHours'=> fake()->WorkHours(),
            'gender'=> fake()->gender(),
            'phone_number'=> fake()->phone_number(),
            'Age'=> fake()->Age(),
            'user_id'=> fake()->user_id(),
        ];
    }
}
