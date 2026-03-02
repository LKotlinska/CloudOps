<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Color;
use App\Models\ProductVape;
use Illuminate\Database\Seeder;

class ProductVapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productIds = Product::pluck('id');
        $colorIds = Color::pluck('id');

        ProductVape::factory()
            ->count($productIds->count())
            ->state(fn() => [
                'product_id' => $productIds->random(),
                'color_id' => $colorIds->random(),
            ])
            ->create();
    }
}
