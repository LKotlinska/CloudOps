<?php

namespace Database\Seeders;

use App\Models\Flavor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlavorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $flavors = [
            'Vanilla',
            'Chocolate',
            'Strawberry',
            'Mango',
            'Caramel',
            'Mint',
            'Watermelon',
            'Liquorice',
        ];

        foreach ($flavors as $name) {
            Flavor::create(['name' => $name]);
        }
    }
}
