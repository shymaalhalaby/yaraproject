<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Diet>
 */
class DietFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'member_id' => \App\Models\Member::factory(),
            'breakfast' => $this->faker->word,
            'snack1' => $this->faker->word,
            'lunch' => $this->faker->word,
            'snack2' => $this->faker->word,
            'dinner' => $this->faker->word,
            'totalCallories' => $this->faker->word,
            'notes' => $this->faker->word,
        ];
    }
}
