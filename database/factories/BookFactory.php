<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),  // ចំណងជើងមានពី ៤ ទៅ ៥ ពាក្យ
            'author' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 5, 50),
            'description' => $this->faker->paragraph(),
            // ទុក category_id និង author_id ឱ្យ Seeder ជាអ្នកបំពេញ
        ];
    }
}
