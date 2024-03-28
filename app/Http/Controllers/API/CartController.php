<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\CartController;
use App\Models\PastOrder; // Add this at the top
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Cart;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class CartController extends Controller
{
    public function index()
    {
        $name = Session::get('name');
        Log::info('Attempting to retrieve cart items.');
        $cartItems = Cart::all();
        Log::info('Retrieved cart items: ' . json_encode($cartItems));
        return view('cart', compact('cartItems'), ['username'=>$name]);
    }
  public function addToCart(Request $request)
{
    $itemId = $request->input('item_id');
    $quantity = $request->input('quantity', 1); // Default to 1 if not provided

    // Fetch the item from the items table using the item_id
    $item = Item::findOrFail($itemId);

    // Get the ID of the authenticated user
    $userId = auth()->id();

    // Create or update the cart item
    $cart = Cart::updateOrCreate(
        [
            'user_id' => $userId,
            'item_id' => $itemId,
        ],
        [
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'image_path' => $item->image_path,
            'quantity' => $quantity,
        ]
    );

    return response()->json(['message' => 'Item added to cart successfully']);
}

    public function addItemToCart(Request $request)
    {
        $itemId = $request->input('item_id');
        $item = Item::find($itemId);

        if (!$item) {
            return response()->json(['message' => 'Item not found'], 404);
        }

        $cartItem = Cart::where('name', $item->name)->first();

        if ($cartItem) {
            // If the item exists, update the quantity
            $cartItem->quantity += 1;
            $cartItem->save();
        } else {
            // If the item does not exist, add it to the cart
            Cart::create([
                'name' => $item->name,
                'description' => $item->description,
                'price' => $item->price,
                'image_path' => $item->image_path,
                'quantity' => 1,
            ]);
        }

        return response()->json(['message' => 'Item added to cart'], 200);
    }

    public function getCartItems()
    {
        $cartItems = Cart::all();
        return view('cart.index', ['cartItems' => $cartItems]);
    }
 public function updateQuantity(Request $request)
    {
        try {
            $itemId = $request->input('item_id');
            $quantity = $request->input('quantity');

            // Update quantity in the database
            $cartItem = Cart::find($itemId);
            $cartItem->quantity = $quantity;

            // Update total price based on the updated quantity
            $cartItem->total_price = $cartItem->price * $quantity;

            $cartItem->save();

            return response()->json(['message' => 'Quantity updated successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Error updating quantity: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }

public function removeCartItem(Request $request)
{
    try {
        $itemId = $request->input('item_id');

        // Remove the item from the database
        Cart::where('id', $itemId)->delete();

        return response()->json(['message' => 'Item removed successfully'], 200);
    } catch (\Exception $e) {
        Log::error('Error removing item: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}
 
public function placeOrder(Request $request)
{
    try {
        // Bypass user authentication for testing purposes
        $userId = 4;

        // Fetch cart items
        $cartItems = Cart::where('user_id', $userId)->get();

        if ($cartItems->isEmpty()) {
            // If the cart is empty, return an error response
            return response()->json(['error' => 'Your cart is empty. Add items before placing an order.'], 400);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Get the last order ID from the database or any source
            $lastOrder = PastOrder::orderBy('id', 'desc')->first();
            $lastOrderId = $lastOrder ? $lastOrder->order_id : 'OF00';
            
            // Extract the numeric part of the last order ID
            $lastOrderIdNumeric = intval(substr($lastOrderId, 2));

            // Increment the numeric part
            $newOrderIdNumeric = $lastOrderIdNumeric + 1;

            // Pad the numeric part to ensure it's always two digits
            $newOrderIdSuffix = str_pad($newOrderIdNumeric, 2, '0', STR_PAD_LEFT);

            // Construct the new order ID
            $orderId = 'OF' . $newOrderIdSuffix;

            // Get the current timestamp
            $timestamp = now();

            // Move cart items to the past_orders table and associate with the order
            foreach ($cartItems as $cartItem) {
                PastOrder::create([
                    'order_id' => $orderId,
                    'user_id' => $userId,
                    'name' => $cartItem->name,
                    'description' => $cartItem->description,
                    'price' => $cartItem->price,
                    'image_path' => $cartItem->image_path,
                    'quantity' => $cartItem->quantity,
                    // Add other fields as needed
                    'created_at' => $timestamp,
                    'updated_at' => $timestamp,
                ]);
            }

            // Commit the database transaction
            DB::commit();

            // Clear the cart after placing the order
            Cart::where('user_id', $userId)->delete();

            // Return a success response
            return response()->json(['message' => 'Your order has been placed successfully!', 'order_id' => $orderId]);
        } catch (\Exception $e) {
            // Rollback the database transaction in case of an error
            DB::rollBack();
            throw $e; // Re-throw the exception after rollback
        }
    } catch (\Exception $e) {
        Log::error('Error placing order: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

public function orderSuccess()
{
    return view('order-success');
}

}
