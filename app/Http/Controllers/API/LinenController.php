<?php

namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Linen;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class LinenController extends Controller
{
    public function index(Request $request)
    {
        $name = Session::get('name');
        $cartItems = session()->get('linen_cart', []);
        $linen = Linen::all();

        Log::info('Linen:', $linen->toArray());

        return view('linen', compact('linen', 'cartItems'), ['username'=>$name]);
    }
    public function addToCart(Request $request)
{
    try {
        // Request validation
        $request->validate([
            'linen_id' => 'required|exists:linen,linen_id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Fetching data from the request
        $quantity = $request->input('quantity', 1);
        $linenId = $request->input('linen_id');

        // Fetch the linen based on the linen_id
        $linen = Linen::findOrFail($linenId);

        // Table name where cart data will be stored
         $tableName = 'linen_cart';// Replace this with your dynamic table name logic if needed

        // Insert or update data in the dynamic table
        \DB::table($tableName)->updateOrInsert(
            ['linen_id' => $linenId],
            [
                'guest_id' => Session::get('id'),
                'name' => $linen->name,
                'image_path' => $linen->image_path,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        return response()->json(['success' => true]);
    } catch (\Exception $e) {
        \Log::error('Error adding linen to cart: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

}
