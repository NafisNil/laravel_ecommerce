<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Color;
use Illuminate\Support\Str;
class ColorController extends Controller
{
    //
    public function index()
    {
        // Logic to display colors
        $colors = Color::all();
        return view('backend.color.index', compact('colors'));
    }

    public function create()
    {
        // Logic to show the form for creating a new color
        return view('backend.color.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new color
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:7', // Assuming hex color code
        ]);

        // Assuming you have a Color model
        $color = Color::create([
            'name' => $request->name,

            'code' => $request->code,
            'status' => $request->status ? true : false,
        ]);

        return redirect()->route('color.index')->with('success', 'Color created successfully.');
    }

    public function edit(Color $color)
    {
        // Logic to show the form for editing a color
        return view('backend.color.edit', compact('color'));
    }

    public function update(Request $request, Color $color)
    {
        // Logic to update a color
        $request->validate([
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:7', // Assuming hex color code
        ]);

        $color->update([
            'name' => $request->name,
            'code' => $request->code,
            'status' => $request->status ? true : false,
        ]);

        return redirect()->route('color.index')->with('success', 'Color updated successfully.');
    }

    public function destroy(Color $color)
    {
        // Logic to delete a color
        $color->delete();
        return redirect()->route('color.index')->with('success', 'Color deleted successfully.');
    }
}
