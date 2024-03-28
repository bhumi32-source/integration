<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\API\ToiCartController;
use Illuminate\Http\Request;
use App\Models\PastToi;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\ToiletriesCart;
use App\Models\CartItem; // Assuming you have a CartItem model
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ToiCartController extends Controller
{
    public function getCartItems()
{
    $name = Session::get('name');
    $cartItems = ToiletriesCart::all();
    return view('toiletries_cart', ['cartItems' => $cartItems], ['username'=>$name]);
}
// Method to remove an item from the cart
   
public function removeCartItem(Request $request)
{
    $toiletriesId = $request->input('toiletries_id');

    // Remove the item from the database
    ToiletriesCart::destroy($toiletriesId);

    return response()->json(['message' => 'Item removed from cart successfully']);
}

  
// Method to update the quantity of an item in the cart
public function updateQuantity(Request $request)
{
    $toiletriesId = $request->input('toiletries_id');
    $change = $request->input('quantity');

    // Retrieve the current cart item
    $cartItem = ToiletriesCart::findOrFail($toiletriesId);

    // Update the quantity of the item in the database
    $cartItem->quantity += $change;
    $cartItem->save();

    return response()->json(['quantity' => $cartItem->quantity]);
}
 public function placeOrder(Request $request)
    {
        try {
            Log::info('Place order method called');

            // Get cart items
            $cartItems = ToiletriesCart::all();

            // Start a database transaction
            DB::beginTransaction();

            try {
                // Get the last order ID from the database or any source
                $lastOrder = PastToi::orderBy('id', 'desc')->first();
                $lastOrderId = $lastOrder ? $lastOrder->order_id : 'TO00';
                
                // Extract the numeric part of the last order ID
                $lastOrderIdNumeric = intval(substr($lastOrderId, 2));

                // Increment the numeric part
                $newOrderIdNumeric = $lastOrderIdNumeric + 1;

                // Pad the numeric part to ensure it's always two digits
                $newOrderIdSuffix = str_pad($newOrderIdNumeric, 2, '0', STR_PAD_LEFT);

                // Construct the new order ID
                $orderId = 'TO' . $newOrderIdSuffix;

                // Move cart items to the past_toi table
                foreach ($cartItems as $cartItem) {
                    PastToi::create([
                        'order_id' => $orderId,
                        'toiletries_id' => $cartItem->toiletries_id,
                        'name' => $cartItem->name,
                        'quantity' => $cartItem->quantity,
                        'image_path' => $cartItem->image_path,
                        // You can add other fields if needed
                    ]);
                }

                // Commit the database transaction
                DB::commit();

                // Clear the cart after moving items
                ToiletriesCart::truncate();

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
public function pastToi()
{
    return view('past_toi');
}
}
