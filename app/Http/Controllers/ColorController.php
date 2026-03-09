<?php

namespace App\Http\Controllers;

use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $colors = Color::paginate(15);

        return view('colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('colors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newColor = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Color::create($newColor);

        return redirect()->route('colors.index')
            ->with('success', 'Color created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Color $color)
    {
        return view('colors.edit', compact('color',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Color $color)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $color->update($validated);

        return redirect()->route('colors.index')
            ->with('success', 'Color updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Color $color)
    {
        if ($color->products()->exists()) {
            return redirect()->back()->with('error', 'Cannot delete "' . $color->name . '" because it has products assigned to it.');
        }

        $color->delete();

        return redirect()->route('colors.index')
            ->with('success', 'Color deleted successfully.');
    }
}
