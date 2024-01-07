<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{

    public function addToCart(Request $request, $id)
    {
        $item = Item::find($id);

        if (!$item) {
            abort(404);
        }

        $user = Auth::user();

        if ($user) {
            // If the user is logged in, store cart items in the database
            $user->items()->attach($id, ['quantity' => 1]); // Attach item to user's cart
        } else {
            // Handle for guests (if needed), using session, for example
            // ... Session logic for guest users
        }

        return redirect()->back()->with('success', 'Item added to cart successfully!');
    }

    public function showCart()
    {
        $user = Auth::user();

        if ($user) {
            // If the user is logged in, retrieve items from the database associated with the user
            $cartItems = $user->items()->get();
            // You might also want to eager load any relationships if needed:
            // $user->load('items');

            return view('cart', ['cartItems' => $cartItems]);
        }

        // If the user is not logged in or there are no items, return an empty cart view
        return view('cart', ['cartItems' => []]);
    }
    public function checkout()
    {
        // Logic for checkout process
        // Redirect or display the checkout view
    }
    public function removeItem($id)
    {
        $user = Auth::user();

        if ($user) {
            $user->items()->detach($id); // Remove the item from the user's cart
        }

        return redirect()->route('cart')->with('success', 'Item removed from cart.');//
    }
}

