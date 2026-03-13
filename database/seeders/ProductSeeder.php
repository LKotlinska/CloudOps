<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Flavor;
use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoryIds = Category::pluck('id');
        $brandIds = Brand::pluck('id');
        $flavorIds = Flavor::pluck('id');

        $products = Product::factory()
            ->count(350)
            ->create([
                'category_id' => fn() => $categoryIds->random(),
                'brand_id' => fn() => $brandIds->random(),
            ]);

        foreach ($products as $product) {
            $product->flavors()->attach($flavorIds->random());
        }
    }
}
