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
