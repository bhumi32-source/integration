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
    $guest_id = Session::get('id');
     $cartItems = ToiletriesCart::where('guest_id',$guest_id)->get();
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
    try {
        $toiletriesId = $request->input('toiletries_id');
        $change = $request->input('quantity');

        // Retrieve the current cart item
        $cartItem = ToiletriesCart::findOrFail($toiletriesId);

        // Update the quantity of the item in the database
        $cartItem->quantity += $change;
        $cartItem->save();

        \Log::info('Quantity updated successfully.', ['toiletries_id' => $toiletriesId, 'new_quantity' => $cartItem->quantity]);

        return response()->json(['quantity' => $cartItem->quantity]);
    } catch (\Exception $e) {
        \Log::error('Error updating quantity: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

 public function placeOrder(Request $request)
    {
        try {
            Log::info('Place order method called');
        $guest_id = Session::get('id');
        // Fetch cart items
        $cartItems = ToiletriesCart::where('guest_id',$guest_id)->get();
           

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
         $guest_id = Session::get('id');
        // Fetch cart items
        $cartItems = ToiletriesCart::where('guest_id',$guest_id)->get();
                // Move cart items to the past_toi table
                foreach ($cartItems as $cartItem) {
                    PastToi::create([
                        'order_id' => $orderId,
                        'guest_id' => Session::get('id'),
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
                ToiletriesCart::where('guest_id', $guest_id)->delete();

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
