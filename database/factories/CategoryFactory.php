<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),  // ពាក្យគំរូ ១ ម៉ាត់ធ្វើជាឈ្មោះប្រភេទសៀវភៅ
            'status' => true,
        ];
    }
}
