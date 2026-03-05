<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
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
    public function definition(): array
    {


        return [
            'category_id' => Category::factory(),
            'name' => fn(array $attributes) => Category::find($attributes['category_id'])->name . ' ' . fake()->words(2, true),
            'description' => fake()->paragraph(),
            'price' => fake()->randomFloat(2, 5.00, 250.00),
            'stock' => fake()->numberBetween(0, 500),
            'nicotine_strength_mg' => fake()->randomElement([0, 3, 6, 12, 18, 20, 50]),
            'volume_ml' => fake()->randomElement([30, 60, 100, 120]),
            'brand_id' => Brand::factory(),
        ];
    }
}
