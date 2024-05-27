<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Image;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // Query parameters
        $search = $request->query('search', '');
        $sortKey = $request->query('sortKey', 'name');
        $sortOrder = $request->query('sortOrder', 'asc');
        $minPrice = $request->query('minPrice', 0);
        $maxPrice = $request->query('maxPrice', 999999.99);

        $query = Product::query();

        // Search filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        // Price filter
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        // Sorting
        $query->orderBy($sortKey, $sortOrder);

        $products = $query->with('image')->get();

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:4096',
            'price' => 'required|numeric|between:0,999999.99',
            'image_id' => 'nullable|exists:images,id'
        ]);

        try {
            $product = Product::create($validatedData);
            return response()->json([
                'message' => 'Product created successfully!',
                'product' => $product
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to create product',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:4096',
            'price' => 'required|numeric|between:0,999999.99',
            'image_id' => 'nullable|exists:images,id'
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->update($validatedData);
            return response()->json([
                'message' => 'Product updated successfully!',
                'product' => $product
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to update product',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json([
                'message' => 'Product deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Failed to delete product',
                'message' => $e->getMessage()
            ], 500);
        }
    }
}