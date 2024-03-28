<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('revalidate');
    }

    public function index(){
        $name = Session::get('name');
        if($name == null){
            return response()->json(['message' => 'Please login first'], 401);
        }else{
            return view('dashboard', ['username'=>$name]);
        }       
    }
}   
