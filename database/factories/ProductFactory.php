<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'summary' => fake()->text(),
            'description' => fake()->text(),
            'image' => fake()->imageUrl(),
            'stock' => fake()->randomDigit(),
            'price' => fake()->randomDigit(),
            'sale_price' => fake()->randomDigit(),
            'discount' => fake()->randomDigit(),
            'weight' => fake()->randomDigit(),
            'category_id' => fake()->randomDigit(20,30),
            'subcategory_id' => fake()->randomDigit(),
            'brand_id' => fake()->randomDigit(),
            'user_id' => fake()->randomDigit(),
            'status' => fake()->randomElement(['active', 'inactive']),
        ];
    }
}
