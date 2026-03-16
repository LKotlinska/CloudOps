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
            'name' => fn(array $attributes) => Category::find($attributes['category_id'])->name . ' ' . $this->faker->words(2, true),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomFloat(2, 5.00, 250.00),
            'stock' => $this->faker->numberBetween(0, 500),
            'nicotine_strength_mg' => $this->faker->randomElement([0, 3, 6, 12, 18, 20, 50]),
            'volume_ml' => $this->faker->randomElement([30, 60, 100, 120]),
            'brand_id' => Brand::factory(),
        ];
    }
}
