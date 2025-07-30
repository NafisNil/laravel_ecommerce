<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Image;
class CategoryController extends Controller
{
    //
    public function index()
    {
        // Logic to display categories
        return view('backend.category.index');
    }
    public function create()
    {
        // Logic to show the form for creating a new category
        return view('backend.category.create');
    }

    public function store(Request $request)
    {
        // Logic to store a new category
        // Validate and save the category data
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // Assuming you have a Category model
        
        $category =Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_active' => $request->status ? true : false,
        ]);

        if ($request->hasFile('image')) {
            $this->_uploadImage($request, $category);
        }
        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit(Category $category)
    {
        // Logic to show the form for editing a category
       
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        // Logic to update an existing category
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'description' => $request->description,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'is_active' => $request->status ? true : false,
        ]);

        if ($request->hasFile('image')) {
            unlink('storage/' . $category->image); // Remove old image if exists
            $this->_uploadImage($request, $category);
        }

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    private function _uploadImage($request, $about)
    {
        # code...
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = 'category'.time() . '.' . $image->guessClientExtension();
            Image::make($image)
                ->resize(128, 128)
                ->save('storage/' . $filename);
            $about->image = $filename;
            $about->save();
        }
    }
}
