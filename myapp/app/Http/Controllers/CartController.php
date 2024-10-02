<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Menu;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        // Validate request
        $request->validate([
            'item_id' => 'required|exists:menus,id', // Ensure the item_id exists in the menus table
            'quantity' => 'required|integer|min:1',
            'name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'token' => 'required|string', // New field for token
        ]);

        // Assume you have a method to get user id from token
        $userId = $this->getUserIdFromToken($request->token);

        if (!$userId) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        Log::info('Item ID: ' . $request->item_id);

        // Find the menu item using the provided item_id
        $menuItem = Menu::find($request->item_id);

        if (!$menuItem) {
            return response()->json(['error' => 'Menu item not found.'], 404);
        }

        // Check if the cart item already exists
        $cartItem = Cart::where('user_id', $userId)
                        ->where('item_id', $menuItem->id)
                        ->first();

        if ($cartItem) {
            // Update the quantity if the item already exists in the cart
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            // Add new item to the cart
            Cart::create([
                'user_id' => $userId,
                'item_id' => $menuItem->id,
                'quantity' => $request->quantity,
                'price' => $menuItem->price,
                'name' => $menuItem->name,
                'description' => $menuItem->description,
            ]);
        }

        return response()->json(['message' => 'Item added to cart successfully'], 200);
    }

    public function getCartItems(Request $request)
    {
        // Validate token
        $request->validate(['token' => 'required|string']);

        $userId = $this->getUserIdFromToken($request->token);

        if (!$userId) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        $cartItems = Cart::where('user_id', $userId)->get();

        return response()->json($cartItems, 200);
    }

    public function updateCartItem(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:carts,item_id',
            'quantity' => 'required|integer|min:1',
            'token' => 'required|string', // New field for token
        ]);

        $userId = $this->getUserIdFromToken($request->token);

        if (!$userId) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('item_id', $request->item_id)
                        ->firstOrFail();

        $cartItem->quantity = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Cart item quantity updated successfully'], 200);
    }

    public function removeFromCart(Request $request)
    {
        $request->validate([
            'item_id' => 'required|exists:carts,item_id',
            'token' => 'required|string', // New field for token
        ]);

        $userId = $this->getUserIdFromToken($request->token);

        if (!$userId) {
            return response()->json(['error' => 'Invalid token.'], 401);
        }

        $cartItem = Cart::where('user_id', $userId)
                        ->where('item_id', $request->item_id)
                        ->firstOrFail();

        $cartItem->delete();

        return response()->json(['message' => 'Item removed from cart successfully'], 200);
    }

    // Dummy function to simulate getting a user ID from a token
    private function getUserIdFromToken($token)
    {
        // Your logic to decode the token and retrieve the user ID
        // This could involve using a library or custom code to handle tokens
        // For now, return a sample user ID for demonstration
        return 1; // Replace this with actual token logic
    }
}
