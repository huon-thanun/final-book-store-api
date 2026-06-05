<?php

namespace Database\Factories;

use App\Models\Author;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Author>
 */
class AuthorFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),  // ឈ្មោះមនុស្ស
            'email' => $this->faker->unique()->safeEmail(),
            'biography' => $this->faker->paragraph(),
        ];
    }
}
