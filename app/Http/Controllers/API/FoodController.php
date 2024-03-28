<?php
// File: app/Http/Controllers/FoodController.php

namespace App\Http\Controllers\API;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Item;
use App\Models\Cart;
use App\Models\BarCategory;
use App\Models\BarItem; 
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class FoodController extends Controller
{
    public function index(Request $request)
{
    $name = Session::get('name');
    $cartItems = session()->get('cart', []);
        $categories = Category::with('items')->get();
        $items = Item::query();

        if ($request->has('category_id')) {
            $category = Category::findOrFail($request->input('category_id'));
            $items = $category->items();
        }

        $items = $items->get();

        return view('orderfood', compact('categories', 'items', 'cartItems'), ['username'=>$name]);
}


public function getBarCategories()
    {
        $categories = BarCategory::all(); // Fetch all bar categories from the database
        return response()->json($categories);
    }
public function getMenuOfTheDayItems()
{
    // Fetch menu of the day items from the database
    $menuOfTheDayItems = Item::where('is_menu_item', true)->get();

    // Return the menu of the day items as JSON response
    return response()->json($menuOfTheDayItems);
}
public function showOrderFoodPage(Request $request)
{
    // Fetch all items regardless of the checkbox state
    $menuItems = Item::all();

    // Pass the menu items to the view
    return view('orderfood', ['menuItems' => $menuItems]);
}

  public function getAllItems()
{
    try {
        $items = Item::all();
        Log::info('Fetched all items successfully.');

        return response()->json($items);
    } catch (\Exception $e) {
        Log::error('Error fetching items: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

public function addToCart(Request $request)
{
    try {
    $request->validate([
        'item_id' => 'required|exists:items,id',
        'quantity' => 'required|integer|min:1',
    ]);
 $quantity = $request->input('quantity', 1);
    $item_id = $request->input('item_id');

    $item = Item::findOrFail($item_id); // Fetch the item based on the item_id

    $tableName = 'cart'; // Replace this with your dynamic table name logic if needed

    // Use the DB facade to insert or update data in the dynamic table
    \DB::table($tableName)->updateOrInsert(
        ['item_id' => $item_id],
        [
            'user_id' => 4,
            'name' => $item->name,
            'description' => $item->description,
            'price' => $item->price,
            'image_path' => $item->image_path,
            'quantity' => $request->input('quantity', 1),
            'created_at' => now(),
            'updated_at' => now(),
        ]
    );

    return response()->json(['success' => true]);
} catch (\Exception $e) {
    \Log::error('Error adding item to cart: ' . $e->getMessage());
    return response()->json(['error' => 'Internal Server Error'], 500);
}

}
 public function fetchMenuOfTheDayItems()
    {
        $menuOfTheDayItems = Food::where('is_menu_item', true)->get();
        return response()->json($menuOfTheDayItems);
    }

    public function getItemsByCategory($categoryId)
{    
    $category = Category::findOrFail($categoryId);
    $items = $category->items;

    return response()->json($items);
}
public function getCartItems()
{
    $cartItems = session()->get('cart', []);
    return response()->json($cartItems);
}
public function showCart()
{
    $cartItems = session()->get('cart', []);
dd($cartItems);
    return view('cart', compact('cartItems'));
}
}
