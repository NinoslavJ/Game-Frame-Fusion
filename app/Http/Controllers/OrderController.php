<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Item;
use Illuminate\Support\Facades\DB; // Import DB facade
class OrderController extends Controller

{
    public function checkout()
    {
        // Implement logic to display checkout page
        return view('checkout');
    }

    public function store(Request $request)
    {
        // Validate request data as needed

        // Get cart items and total from the request
        $items = $request->input('items');
        $totalAmount = $request->input('total');

        // Create an order
        $order = new Order();
        $order->user_id = Auth::id(); // Assuming user is authenticated
        $order->items = $items;
        $order->total_amount = $totalAmount;
        $order->save();

        //Clear the user's cart after the order is created
        $userId = Auth::id();
        DB::table('cart')->where('user_id', $userId)->delete(); // Delete cart items for the current user

        // Redirect to the dashboard after the order is successfully created
        return redirect()->route('dashboard')->with('success', 'Order placed successfully');
    }
    public function userOrders()
    {
        // Get the authenticated user's orders
        $user = Auth::user();
        $userOrders = Order::where('user_id', $user->id)->get();

        $formattedOrders = [];
        foreach ($userOrders as $order) {
            $formattedItems = json_decode($order->items, true);
            foreach ($formattedItems as &$item) {
                $itemDetails = Item::find($item['id']); // Assuming Item model has the picture field
                $item['picture'] = $itemDetails->picture;
            }
            $formattedOrders[] = [
                'order_id' => $order->id,
                'items' => $formattedItems,
                'total_amount' => $order->total_amount,
            ];
        }

        return view('user_orders', ['orders' => $formattedOrders]);
    }
}