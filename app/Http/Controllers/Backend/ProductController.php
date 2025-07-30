<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\ProductImage;

class ProductController extends Controller
{
    //
    public function index()
    {
        // Logic to display products
        $products = Product::all();
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        // Logic to show the product creation form
        $categories = Category::all(); // Fetch all categories for the form
        $brands = Brand::all(); // Fetch all brands for the form
        return view('backend.product.create', compact('categories', 'brands'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData =$request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required',
            'original_price' => 'required|numeric',

            'description' => 'nullable|string',
            'status' => 'required',

            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate images
        ]);

        $categories = Category::find($validatedData['category_id']);
        $product = $categories->products()->create([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
            'category_id' => $validatedData['category_id'],
            'brand' => $validatedData['brand'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'description' => $validatedData['description'],
            'short_description' => $request->short_description,
            'status' => $request->status ? true : false,
            'trending' => $request->trending ? true : false,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);
        // Logic to store the product
       if ($request->hasFile('image')) {
           $this->_uploadImage($request, $product);
       }
       return redirect()->route('product.index')->with('success', 'Product created successfully.');

    }

    public function edit(Product $product)
    {
        // Logic to show the form for editing a product
        $categories = Category::all(); // Fetch all categories for the form
        $brands = Brand::all(); // Fetch all brands for the form
        return view('backend.product.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand' => 'required',
            'original_price' => 'required|numeric',

            'description' => 'nullable|string',
            'status' => 'required',

            'image.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validate images
        ]);

        $product->update([
            'name' => $validatedData['name'],
            'slug' => Str::slug($validatedData['name']),
            'category_id' => $validatedData['category_id'],
            'brand' => $validatedData['brand'],
            'original_price' => $validatedData['original_price'],
            'selling_price' => $request->selling_price,
            'quantity' => $request->quantity,
            'description' => $validatedData['description'],
            'short_description' => $request->short_description,
            'status' => $request->status ? true : false,
            'trending' => $request->trending ? true : false,
            'meta_title' => $request->meta_title,
            'meta_keywords' => $request->meta_keywords,
            'meta_description' => $request->meta_description,
        ]);

        if ($request->hasFile('image')) {
            
            $this->_uploadImage($request, $product);
        }

        return redirect()->route('product.index')->with('success', 'Product updated successfully.');
    }

    private function _uploadImage($request, $product)
    {
        if ($request->hasFile('image')) {
            $images = $request->file('image');
            // Handle both single and multiple file uploads
            if (!is_array($images)) {
                $images = [$images];
            }
            foreach ($images as $image) {
                $filename = 'product' . time() . uniqid() . '.' . $image->guessClientExtension();
                Image::make($image)
                    ->resize(400, 500)
                    ->save('storage/' . $filename);
                $product->productImages()->create([
                    'image' => $filename,
                    'product_id' => $product->id,
                    'alt_text' => $product->name, // Optional alt text
                ]);
            }
        }
    }

    public function destroy(Product $product)
    {
        // Logic to delete a product
        foreach ($product->productImages as $image) {
            unlink('storage/' . $image->image); // Remove image file
            $image->delete(); // Delete image record
        }
        $product->delete(); // Delete product record
        return redirect()->route('product.index')->with('success', 'Product deleted successfully.');
    }


    public function destroyImage(ProductImage $image)
    {
        // Delete image file from storage
        $imagePath = public_path('storage/' . $image->image);
        if (file_exists($imagePath)) {
            unlink($imagePath);
        }
        $image->delete();
        return back()->with('success', 'Product image deleted successfully.');
    }
}
