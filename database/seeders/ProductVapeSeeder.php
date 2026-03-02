<?php

namespace Database\Seeders;

use App\Models\Color;
use App\Models\Product;
use App\Models\ProductVape;
use Illuminate\Database\Seeder;

class ProductVapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get the colors from the database later
        $colors = [
            'Black',
            'White',
            'Blue',
            'Red',
            'Green',
            'Purple',
            'Silver',
            'Gold',
            'Rose Gold',
            'Gunmetal',
        ];

        foreach ($colors as $color) {
            Color::create(['name' => $color]);
        }

        $productIds = Product::pluck('id');
        $colorIds = Color::pluck('id');

        ProductVape::factory()
            ->count($productIds->count())
            ->create([
                'product_id' => fn() => $productIds->random(),
                'color_id' => fn() => $colorIds->random(),
            ]);
    }
}
