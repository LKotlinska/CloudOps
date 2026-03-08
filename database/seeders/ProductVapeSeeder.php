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
        $vapeProductIds = Product::whereHas('category', fn($q) => $q->where('name', 'Vape'))->pluck('id');
        $colorIds = Color::pluck('id');

        foreach ($vapeProductIds as $productId) {
            ProductVape::factory()->create([
                'product_id' => $productId,
                'color_id' => $colorIds->random(),
            ]);
        }
    }
}
