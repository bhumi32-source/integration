<?php

namespace App\Http\Controllers\API;
use App\Models\PastToi;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
class PastToiController extends Controller
{
    public function index()
    {
        $name = Session::get('name');
        // Retrieve past orders from the database
        $pastOrders = PastToi::all();

        // Pass the past orders data to the view
        return view('past_toi', ['pastOrders' => $pastOrders], ['username'=>$name]);
    }
}
