<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(15);

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newCategory = $request->validate([
            'name' => 'required|string|min:3|max:100',
        ]);

        Category::create($newCategory);

        return redirect()->route('categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('categories.edit', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $newCategory = $request->validate([
            'name' => 'required|string|min:3|max:100',
        ]);

        $category->update($newCategory);

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        if ($category->products()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete "' . $category->name . '" because it has products assigned to it.');
        }

        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted.');
    }
}
