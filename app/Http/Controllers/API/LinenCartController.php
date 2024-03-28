<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\LinenCartItem;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\LinenPast;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class LinenCartController extends Controller
{
    public function index()
    {
        $name = Session::get('name');
        // Retrieve cart items from the database
        $cartItems = LinenCartItem::all();

        // Pass cart items to the view
        return view('linen_cart', compact('cartItems'), ['username'=>$name]);
    }

    // Method to remove an item from the cart
    public function removeCartItem(Request $request)
    {
        $linenId = $request->input('linen_id');

        // Remove the item from the database
        LinenCartItem::destroy($linenId);

        return response()->json(['message' => 'Item removed from cart successfully']);
    }
public function getQuantity(Request $request)
{
    $linenId = $request->input('linen_id');
    $cartItem = LinenCartItem::findOrFail($linenId);
    
    return response()->json(['quantity' => $cartItem->quantity]);
}

    // Method to update the quantity of an item in the cart
    public function updateQuantity(Request $request)
    {
        $linenId = $request->input('linen_id');
        $change = $request->input('quantity');

        // Retrieve the current cart item
        $cartItem = LinenCartItem::findOrFail($linenId);

        // Update the quantity of the item in the database
        $cartItem->quantity += $change;
        $cartItem->save();

        return response()->json(['quantity' => $cartItem->quantity]);
    }

public function placeOrder(Request $request)
{
    try {
        Log::info('Place order method called'); // Log: Check if the method is called

        // Get cart items
        $cartItems = LinenCartItem::all();
        Log::info('Cart items retrieved'); // Log: Check if cart items are retrieved

        // Start a database transaction
        DB::beginTransaction();
        Log::info('Database transaction started'); // Log: Check if the transaction is started successfully

        try {
            // Get the last order ID from the database or any source
            $lastOrder = LinenPast::orderBy('id', 'desc')->first();
            $lastOrderId = $lastOrder ? $lastOrder->order_id : 'LO00';
            
            // Extract the numeric part of the last order ID
            $lastOrderIdNumeric = intval(substr($lastOrderId, 2));

            // Increment the numeric part
            $newOrderIdNumeric = $lastOrderIdNumeric + 1;

            // Pad the numeric part to ensure it's always two digits
            $newOrderIdSuffix = str_pad($newOrderIdNumeric, 2, '0', STR_PAD_LEFT);

            // Construct the new order ID
            $orderId = 'LO' . $newOrderIdSuffix;
            Log::info('New order ID created: ' . $orderId); // Log: Check if the new order ID is generated successfully

            // Move cart items to the linen_past table
            foreach ($cartItems as $cartItem) {
                LinenPast::create([
                    'order_id' => $orderId,
                    'linen_id' => $cartItem->linen_id,
                    'name' => $cartItem->name,
                    'quantity' => $cartItem->quantity,
                    'image_path' => $cartItem->image_path,
                    // You can add other fields if needed
                ]);
            }
            Log::info('Cart items moved to linen_past table'); // Log: Check if cart items are successfully moved to linen_past table

            // Commit the database transaction
            DB::commit();
            Log::info('Database transaction committed'); // Log: Check if the transaction is committed successfully

            // Clear the cart after moving items
            LinenCartItem::truncate();
            Log::info('Cart items cleared'); // Log: Check if cart items are cleared successfully

            Log::info('Records successfully created in linen_past table');
            return response()->json(['message' => 'Order placed successfully']);
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollBack();
            Log::error('Error placing order: ' . $e->getMessage());
            return response()->json(['message' => 'Failed to place the order. Please try again later.'], 500);
        }
    } catch (\Exception $e) {
        Log::error('Error placing order: ' . $e->getMessage());
        return response()->json(['message' => 'Failed to place the order. Please try again later.'], 500);
    }
}



}
