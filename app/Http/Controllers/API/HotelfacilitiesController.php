<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facilities;
use App\Models\Decoration;
use Illuminate\Support\Facades\Session;

class HotelfacilitiesController extends Controller
{
    public function index(){
        $name = Session::get('name');
        if($name == null){
            return redirect()->route('login');
        }else{
        $facilities = Facilities::all();
        return view('hotelfacilities',['facilities' => $facilities], ['username'=>$name]);
        }
    }

    public function customDecoration()
    {
        $decorations = Decoration::all();

        return view('custom_decoration', ['decorations' => $decorations]);
    }


}
