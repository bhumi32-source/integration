<?php

namespace App\Http\Controllers\API;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;
class MenuController extends Controller
{
    /**
     * Display the menu page.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {
        $name = Session::get('name');
        // Fetch menu items where is_menu_item is true
        $menuItems = Item::where('is_menu_item', true)->get();

        return view('menu', compact('menuItems'), ['username'=>$name]);
    }
}
