<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Flavor;
use App\Models\Color;

class HomeController extends Controller
{
    /**
     * Show the start page with filters and stats.
     */
    public function startPage(Request $request)
    {
        $query = Product::with(['category', 'brand', 'flavors', 'productVape.color']);

        // Filter by category tab
        if ($request->filled('category')) {
            $query->where('category_id', (int) $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand_id', (int) $request->brand);
        }

        // Filter by search (name or brand name)
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhereHas('brand', fn($inner) => $inner->where('name', 'like', '%' . $request->search . '%'));
            });
        }

        // Filter by price range
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }

        // Filter by stock status
        if ($request->filled('stock')) {
            match ($request->stock) {
                'in_stock'  => $query->where('stock', '>=', 10),
                'low_stock' => $query->whereBetween('stock', [1, 9]),
                'out'       => $query->where('stock', 0),
                default     => null,
            };
        }

        // Filter by flavor (via flavor_product join table)
        if ($request->filled('flavor')) {
            $query->whereHas('flavors', fn($q) => $q->where('flavors.id', $request->flavor));
        }

        // Filter by color (via product_vapes table)
        if ($request->filled('color')) {
            $query->whereHas('productVape', fn($q) => $q->where('color_id', $request->color));
        }

        $products = $query->get();
        $categories = Category::all();
        $brands     = Brand::all();
        $flavors    = Flavor::all();
        $colors     = Color::all();

        // Count products per category for stats cards
        $counts = $products
            ->groupBy(fn($product) => $product->category->name)
            ->map->count();

        return view('start-page', compact(
            'products',
            'categories',
            'brands',
            'flavors',
            'colors',
            'counts'
        ));
    }
}
