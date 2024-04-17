<?php
namespace App\Http\Controllers\API;
use App\Models\LinenPast; // Make sure to import the LinenPast model
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PastLinenController extends Controller
{
    public function index()
    {
        $name = Session::get('name');
        // Retrieve past orders from the LinenPast model
          $guest_id = Session::get('id');
          $pastOrders = LinenPast::where('guest_id',$guest_id)->get();
        // Pass the $pastOrders variable to the view
        return view('past_linen', compact('pastOrders'), ['username'=>$name]);
    }
}
