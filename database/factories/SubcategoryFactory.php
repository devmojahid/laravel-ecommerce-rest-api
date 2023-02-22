<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subcategory>
 */
class SubcategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'slug' => fake()->slug(),
            'description' => fake()->text(),
            'category_id' => fake()->numberBetween(1, 10),
            'image' => fake()->imageUrl(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
