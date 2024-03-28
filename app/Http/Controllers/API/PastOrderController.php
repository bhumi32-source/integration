<?php
// app/Http/Controllers/PastOrderController.php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\PastOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PastOrderController extends Controller
{
     public function index()
    {
        $name = Session::get('name');
        $pastOrders = PastOrder::get();
        return view('past_order', compact('pastOrders'), ['username'=>$name]);
    }
}
