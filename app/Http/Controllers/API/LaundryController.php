<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LaundryType;
use App\Models\LaundryOrder;
use Illuminate\Support\Facades\Session;
use App\Models\ServiceOrder;
use App\Models\LaundryOrderView;
use App\Models\Service;

class LaundryController extends Controller
{
    public function index(){
        $name = Session::get('name');
        $types = LaundryType::all();
        return view('laundry',['types'=>$types], ['username'=>$name]);

    }

    public function store(Request $request){
        //validate data
        $request->validate([
            'laundryType' => 'required|in:1,2,3,4'
        ]);

        $serviceOrder = new ServiceOrder();
        $service = Service::where('title', 'LIKE', 'laundry%')->first();
        $serviceId = $service ? $service->id : null;
        $serviceOrder->service_id = $serviceId; 
        $serviceOrder->booking_date_time = now();
        $serviceOrder->guest_id = Session::get('id');
        $serviceOrder->save();
    
        $bookingReferenceNumber = 'L' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
        $serviceOrder->booking_reference_number = $bookingReferenceNumber;
        $serviceOrder->save();

        $laundryOrder = new LaundryOrder();
        $laundryOrder->laundry_type_id = $request->input('laundryType');
        $laundryOrder->service_order_id = $serviceOrder->id;
        $laundryOrder->special_request = $request->input('specialRequest');
        $laundryOrder->save();

        return redirect()->route('laundry.list');
       
    }

    public function show(){
        $guestId = Session::get('id');
        $Orders = LaundryOrderView::where('guest_id', $guestId)
        ->orderByDesc('booking_date_time')
        ->get();

        return view('laundryorders',['orders' => $Orders]);

    }
}
