<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        Log::info('Add to cart request received', $request->all());

        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $validatedData = $request->validate([
                'product_id' => 'required|exists:products,id',
                'quantity' => 'required|integer|min:1'
            ]);

            $cartItem = Cart::updateOrCreate(
                ['user_id' => $user->id, 'product_id' => $validatedData['product_id']],
                ['quantity' => $validatedData['quantity']]
            );

            return response()->json(['message' => 'Product added to cart successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error adding to cart', ['exception' => $e]);
            return response()->json(['error' => 'Internal Server Error', 'message' => $e->getMessage()], 500);
        }
    }

    public function getCartItems()
    {
        $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
        return response()->json($cartItems, 200);
    }

    public function removeFromCart($id)
    {
        $cartItem = Cart::where('user_id', auth()->id())->where('product_id', $id)->first();
        
        if ($cartItem) {
            $cartItem->delete();
            return response()->json(['message' => 'Product removed from cart successfully!'], 200);
        }

        return response()->json(['message' => 'Product not found in cart!'], 404);
    }

    public function getTotal()
    {
        $total = Cart::join('products', 'cart_items.product_id', '=', 'products.id')
            ->sum('products.price * cart_items.quantity');
            
        return response()->json(['total' => $total]);
    }
}