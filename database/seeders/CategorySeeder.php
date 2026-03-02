<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Disposables', 'Pod Systems', 'Box Mods', 'Starter Kits',
            'Tanks', 'Coils', 'E-Liquids', 'Salts', 'Accessories', 'Batteries',
        ];

        foreach ($categories as $name) {
            Category::create(['name' => $name]);
        }
    }
}
