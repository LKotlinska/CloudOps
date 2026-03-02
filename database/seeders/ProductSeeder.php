<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
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

        Product::factory()
            ->count(30)
            ->create([
                'category_id' => fn() => $categoryIds->random(),
                'brand_id' => fn() => $brandIds->random(),
            ]);
    }
}
