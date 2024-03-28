<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class RoomServiceController extends Controller
{
    public function index(){
        $name = Session::get('name');
        return view ('roomservice', ['username'=>$name]);
    }
}
