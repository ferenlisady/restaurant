<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Menu;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orderPage()
    {
        $orders = Order::where('user_id', auth()->id())->get(); // Fetch orders for the authenticated user
        // Calculate the total amount dynamically based on quantity * price
        $totalAmount = $orders->sum(function ($order) {
            return $order->quantity * $order->menu->price; // Recalculate amount for each order
        });

        return view('order.index', compact('orders', 'totalAmount'));
    }

    public function addToOrder($menuId)
    {
        $menu = Menu::findOrFail($menuId);
        $userId = auth()->id();

        // Check if the user already has this menu in their order
        $existingOrder = Order::where('user_id', $userId)
            ->where('menu_id', $menu->id)
            ->first();

        if ($existingOrder) {
            // If the menu item already exists, just update the quantity
            $existingOrder->quantity += 1; // Increase quantity by 1
            $existingOrder->amount = $existingOrder->quantity * $menu->price; // Update amount
            $existingOrder->save();
        } else {
            // If the menu item doesn't exist, create a new order
            Order::create([
                'user_id' => $userId,
                'menu_id' => $menu->id,
                'quantity' => 1, // Default to quantity 1
                'amount' => $menu->price, // Initial amount (quantity * price)
            ]);
        }

        return redirect()->back()->with('success', 'Menu item added to your order');
    }

    public function updateQuantity(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Get the new quantity from the form submission
        $newQuantity = $request->quantity;

        // Update the order quantity
        $order->quantity = $newQuantity;
        // Recalculate the amount based on the updated quantity
        $order->amount = $order->quantity * $order->menu->price;
        $order->save();

        return redirect()->route('order.index')->with('success', 'Order quantity updated.');
    }

    public function delete($orderId)
    {
        // Find the order by ID
        $order = Order::findOrFail($orderId);

        // Delete the order
        $order->delete();

        // Redirect back with a success message
        return redirect()->route('order.index')->with('success', 'Order deleted successfully.');
    }

    public function checkout()
    {
        // Get the user's orders
        $orders = Order::where('user_id', auth()->id())->get();

        // Check if there are any orders to delete
        if ($orders->isNotEmpty()) {
            // Delete all orders
            $orders->each->delete();

            // Show a success message and redirect to the orders page
            return redirect()->route('order.index')->with('success', 'Your orders have been successfully checked out.');
        } else {
            // If no orders exist, show an error message
            return redirect()->route('order.index')->with('error', 'No orders found to checkout.');
        }
    }
}