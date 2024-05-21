<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        //query parameters
        $search = $request->query('search');
        $sortKey = $request->query('sortKey', 'name');
        $sortOrder = $request->query('sortOrder', 'asc');
        $minPrice = $request->query('minPrice', 0);
        $maxPrice = $request->query('maxPrice', 999999.99);

        $query = Product::query();

        //search filter
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        //price filter
        $query->whereBetween('price', [$minPrice, $maxPrice]);

        //sorting
        $query->orderBy($sortKey, $sortOrder);

        $products = $query->get();

        return response()->json($products, 200);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:4096',
            'price' => 'required|numeric|between:0,999999.99',
            'image' => 'required|string|max:255|url'
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
}