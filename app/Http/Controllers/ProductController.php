<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
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
        $products = Product::with(['brand', 'flavors', 'productVape.color'])->paginate(15);
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
        $flavors = Flavor::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();

        return view(
            'products.create',
            [
                'categories' => $categories,
                'brands' => $brands,
                'flavors' => $flavors,
                'colors' => $colors,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newProduct = $request->validate([
            // Always required fields
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3|max:250',
            'price' => 'required|numeric|gt:1',
            'stock' => 'required|integer|gte:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'nicotine_strength_mg' => 'nullable|integer|gte:0',
            'volume_ml' => 'nullable|integer|gte:0',

            'flavor_id' => 'nullable|exists:flavors,id',

            // Conditional fields - vape specific
            'has_podsystem' => 'sometimes|boolean',
            'puff_count' => 'sometimes|integer|min:1',
            'color_id' => 'sometimes|exists:colors,id'
        ]);

        $product = Product::create(Arr::except($newProduct, ['flavor_id', 'has_podsystem', 'puff_count', 'color_id']));

        if (!empty($newProduct['flavor_id'])) {
            $product->flavors()->attach($newProduct['flavor_id']);
        }

        $vapeCategory = Category::where('name', 'Vape')->first();

        if ($newProduct['category_id'] == $vapeCategory?->id) {
            $product->productVape()->create([
                'has_podsystem' => $request->boolean('has_podsystem'),
                'puff_count'    => Arr::get($newProduct, 'puff_count'),
                'color_id'      => Arr::get($newProduct, 'color_id'),
            ]);
        }

        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('products.read', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $flavors = Flavor::all();
        $categories = Category::all();
        $brands = Brand::all();
        $colors = Color::all();

        return view(
            'products.edit',
            [
                'categories' => $categories,
                'brands' => $brands,
                'flavors' => $flavors,
                'colors' => $colors,
                'product' => $product
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $updatedProduct = $request->validate([
            // Always required fields
            'name' => 'required|string|min:3|max:100',
            'description' => 'required|string|min:3|max:250',
            'price' => 'required|numeric|gt:1',
            'stock' => 'required|integer|gte:0',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'required|exists:brands,id',
            'nicotine_strength_mg' => 'nullable|integer|gte:0',
            'volume_ml' => 'nullable|integer|gte:0',

            'flavor_id' => 'nullable|exists:flavors,id',

            // Conditional fields - vape specific
            'has_podsystem' => 'sometimes|boolean',
            'puff_count' => 'sometimes|integer|min:1',
            'color_id' => 'sometimes|exists:colors,id'
        ]);

        $product->update(Arr::except($updatedProduct, ['flavor_id', 'has_podsystem', 'puff_count', 'color_id']));

        $product->flavors()->sync(!empty($updatedProduct['flavor_id']) ? [$updatedProduct['flavor_id']] : []);

        $vapeCategory = Category::where('name', 'Vape')->first();

        if ($updatedProduct['category_id'] == $vapeCategory?->id) {
            $product->productVape()->updateOrCreate(
                ['product_id' => $product->id],
                [
                    'has_podsystem' => $request->boolean('has_podsystem'),
                    'puff_count'    => Arr::get($updatedProduct, 'puff_count'),
                    'color_id'      => Arr::get($updatedProduct, 'color_id'),
                ]
            );
        }

        return redirect()->route('products.index')->with('success', 'Product updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        Product::destroy($product->id);
        return redirect()->route('products.index')->with('success', 'Product deleted.');
    }
}
