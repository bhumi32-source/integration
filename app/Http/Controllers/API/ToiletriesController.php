<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Toiletries;
use Illuminate\Support\Facades\Session;
use App\Models\ToiletriesCart;
use App\Http\Controllers\Controller;

class ToiletriesController extends Controller
{
    public function index(Request $request)
    {
        $name = Session::get('name');
         $guest_id = Session::get('id');
        //Log::info('Toiletries:', $toiletries->toArray());
 $toiletries = Toiletries::all();
  $cartItems = session()->get('toiletries_cart', []);
        return view('toiletries', compact('toiletries', 'cartItems'), ['username'=>$name]);
    }

    public function getAllToiletries()
    {
        try {
            $toiletries = Toiletries::all();
            Log::info('Fetched all toiletries successfully.');

            return response()->json($toiletries);
        } catch (\Exception $e) {
            Log::error('Error fetching toiletries: ' . $e->getMessage());
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }
public function addToCart(Request $request)
{
    try {
        // Request validation
         $request->validate([
            'toiletries_id' => 'required|exists:toiletries,toiletries_id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetching data from the request
        $quantity = $request->input('quantity', 1);
        $toiletriesId = $request->input('toiletries_id'); // Corrected variable name

        // Fetch the toiletry based on the toiletries_id
        $toiletry = Toiletries::findOrFail($toiletriesId);

        // Table name where cart data will be stored
        $tableName = 'toiletries_cart'; // Replace this with your dynamic table name logic if needed

        // Insert or update data in the dynamic table
        \DB::table($tableName)->updateOrInsert(
            ['toiletries_id' => $toiletriesId], // Corrected column name
            [
                 'guest_id' => Session::get('id'),
                'name' => $toiletry->name,
                'image_path' => $toiletry->image_path,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error('Error adding toiletry to cart: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

  


}
