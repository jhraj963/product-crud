<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'primary_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additional_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $primaryImagePath = $request->file('primary_image')->store('products', 'public');

        $product = Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'primary_image' => $primaryImagePath,
        ]);


        if ($request->hasFile('additional_images')) {
            foreach ($request->file('additional_images') as $image) {
                $imagePath = $image->store('product_images', 'public');
                $product->images()->create(['image_path' => $imagePath]);
            }
        }

        return response()->json(['message' => 'Product created successfully']);
    }


    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);

        return response()->json([
            'product' => $product,
            'primary_image_url' => asset('storage/' . $product->primary_image),
            'additional_images' => $product->images->map(function ($image) {
                return asset('storage/' . $image->image_path);
            }),
        ]);
    }
}
