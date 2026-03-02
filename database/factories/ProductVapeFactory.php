<?php

namespace Database\Factories;

use App\Models\Color;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVape>
 */
class ProductVapeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'has_podsystem' => fake()->boolean(),
            'puff_count' => fake()->numberBetween(200, 15000),
            'product_id' => Product::factory(),
            'color_id' => fn() => Color::factory(),
        ];
    }
}
