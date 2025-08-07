<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use Image;
class SliderController extends Controller
{
    //
    public function index()
    {
        // Logic to display sliders
        $sliders = Slider::all(); // Assuming you have a Slider model
        return view('backend.slider.index', compact('sliders'));
    }

    public function create()
    {
        // Logic to show the slider creation form
        return view('backend.slider.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            // 'status' => 'required',
        ]);
      
        // Create a new slider
        $slider = Slider::create([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            // 'image' => $request->file('image')->store('sliders', 'public'),
            'status' => $request->status ? true : false,
        ]);

        if ($request->hasFile('image')) {
            // unlink('storage/' . $slider->image); // Remove old image if exists
            $this->_uploadImage($request, $slider);
        }

        return redirect()->route('slider.index')->with('success', 'Slider created successfully.');
    }

    public function edit(Slider $slider)
    {
        // Logic to show the form for editing a slider

        return view('backend.slider.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate image
            // 'status' => 'required',
        ]);

        // Update the slider
        $slider->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description'],
            // 'image' => $request->file('image')->store('sliders', 'public'),
            'status' => $request->status ? true : false,
        ]);

        if ($request->hasFile('image')) {
            unlink('storage/' . $slider->image); // Remove old image if exists
            $this->_uploadImage($request, $slider);
        }

        return redirect()->route('slider.index')->with('success', 'Slider updated successfully.');
    }

    public function destroy(Slider $slider)
    {
        // Logic to delete a slider
        if ($slider->image) {
            unlink('storage/' . $slider->image); // Remove image file
        }
        $slider->delete();
        return redirect()->route('slider.index')->with('success', 'Slider deleted successfully.');
    }

    private function _uploadImage($request, $slider)
    {
        # code...
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'slider' . time() . '.' . $image->guessClientExtension();
            Image::make($image)
                ->resize(1920, 1080)
                ->save('storage/' . $filename);
            $slider->image = $filename;
            $slider->save();
        }
    }
}
