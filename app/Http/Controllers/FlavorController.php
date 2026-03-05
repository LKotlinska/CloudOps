<?php

namespace App\Http\Controllers;

use App\Models\Flavor;
use Illuminate\Http\Request;

class FlavorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $flavors = Flavor::all();

        return view('flavors.index', compact('flavors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('flavors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $newFlavor = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Flavor::create($newFlavor);

        return redirect()->route('flavors.index')
            ->with('success', 'Flavor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Flavor $flavor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Flavor $flavor)
    {
        return view('flavors.edit', compact('flavor',));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Flavor $flavor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $flavor->update($validated);

        return redirect()->route('flavors.index')
            ->with('success', 'Flavor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Flavor $flavor)
    {
        $flavor->delete();

        return redirect()->route('flavors.index')
            ->with('success', 'Flavor deleted successfully.');
    }
}
