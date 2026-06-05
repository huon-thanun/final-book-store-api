<?php

namespace Database\Factories;

use App\Models\BookDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<BookDetail>
 */
class BookDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->paragraph(),  // 🌟 បោះទិន្នន័យក្លែងក្លាយចូល description ពេលរត់ Seeder
            'publisher' => $this->faker->company(),
            'language' => 'Khmer',
            'page_count' => $this->faker->numberBetween(100, 500),
        ];
    }
}
