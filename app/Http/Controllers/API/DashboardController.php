<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Feedback;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('revalidate');
    }

    public function index(){
        $name = Session::get('name');
        $comments = Feedback::all();
        if($name == null){
            return redirect()->route('login');
        }else{
            return view('dashboard', ['username'=>$name],['comments'=>$comments]);
        }       
    }
}   
