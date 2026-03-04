<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Flavor;
use App\Models\Color;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['brand', 'flavors', 'productVapes.color'])->get();
        $brands   = Brand::all();
        $flavors  = Flavor::all();
        $colors   = Color::all();

        return view('products.index', compact('products', 'brands', 'flavors', 'colors'));
    }

    /**
     * Show the start page with filters and stats.
     */
    public function startPage(Request $request)
    {
        $query = Product::with(['category', 'brand', 'flavors', 'productVapes.color']);

        // Filter by category tab
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by brand
        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
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
            $query->whereHas('productVapes', fn($q) => $q->where('color_id', $request->color));
        }

        $products = $query->get();
        $categories = Category::all();
        $brands     = Brand::all();
        $flavors    = Flavor::all();
        $colors     = Color::all();

        // Count products per category for stats cards
        $counts = Product::join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, count(*) as total')
            ->groupBy('categories.name')
            ->pluck('total', 'name');

        return view('start-page', compact(
            'products',
            'categories',
            'brands',
            'flavors',
            'colors',
            'counts'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view(
            'products.create',
            [
                'categories' => $categories,
                'brands' => $brands
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newProduct = $request->validate([
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3|max:250',
            'price' => 'required|numeric|gt:1',
            'stock' => 'required|integer|gte:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'nicotine_strength_mg' => 'required|numeric|gte:0',
            'volume_ml' => 'required|numeric|gte:0',
        ]);

        Product::create($newProduct);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
