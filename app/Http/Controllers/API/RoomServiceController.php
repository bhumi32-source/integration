<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Service;

class RoomServiceController extends Controller
{
    public function index(){
        $name = Session::get('name');
        if($name == null){
            return redirect()->route('login');
        }else{
        $services = Service::all();
        return view ('roomservice', ['username'=>$name],['services'=>$services]);
        }
    }
}
