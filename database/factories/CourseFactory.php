<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'description' => $this->faker->optional()->text(),
            'start_date' => $this->faker->optional()->date(),
            'end_date' => $this->faker->optional()->date(),
            'difficulty_level' => $this->faker->optional()->randomElement(['beginner', 'intermediate', 'advanced']),
            'category' => $this->faker->optional()->word(),
            'updated_by' => User::inRandomOrder()->take(1)->value('id'),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
