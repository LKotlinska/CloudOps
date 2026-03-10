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
            // Fruits
            'Mango Tango',
            'Strawberry Fields',
            'Blue Raspberry',
            'Watermelon Frost',
            'Peach Nectar',
            'Lychee Ice',
            'Passion Fruit',
            'Kiwi Strawberry',
            'Pineapple Crush',
            'Dragon Fruit',
            'Blackberry Lemonade',
            'Grape Ice',
            'Apple Sour',
            'Cherry Bomb',
            'Tropical Punch',
            'Honeydew Melon',
            'Papaya Mango',
            'Coconut Lime',
            'Blood Orange',
            'Pomegranate Berry',

            // Menthol / Ice
            'Spearmint Ice',
            'Cool Mint',
            'Arctic Blast',
            'Polar Ice',
            'Menthol Fresh',

            // Desserts / Sweets
            'Vanilla Custard',
            'Caramel Latte',
            'Strawberry Cheesecake',
            'Blueberry Muffin',
            'Chocolate Fudge',
            'Cinnamon Roll',
            'Cotton Candy',
            'Banana Pudding',
            'Peach Cobbler',
            'Glazed Donut',

            // Beverages
            'Iced Coffee',
            'Pink Lemonade',
            'Green Tea Ice',
            'Watermelon Slush',
            'Grape Soda',
            'Cola Ice',
            'Orange Creamsicle',
            'Mango Lassi',
            'Strawberry Milkshake',
            'Peach Iced Tea',

            // Tobacco / Classic
            'Classic Tobacco',
            'Virginia Gold',
            'Cuban Cigar',
            'Smooth Tobacco',
            'Honey Tobacco',
        ];

        foreach ($flavors as $name) {
            Flavor::create(['name' => $name]);
        }
    }
}
