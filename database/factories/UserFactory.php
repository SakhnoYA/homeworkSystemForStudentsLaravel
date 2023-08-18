<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->numberBetween(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->optional()->middleName,
            'password' => $this->faker->password(),
            'user_type_id' => $this->faker->numberBetween(2, 3),
            'ip' => $this->faker->optional()->ipv4,
            'is_confirmed' => false,
            'remember_token' => $this->faker->word(),
            'created_at' => now(),
            'updated_at' => now(),
            'deleted_at' => null,
        ];
    }
}
