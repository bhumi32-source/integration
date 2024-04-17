<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ExtraBedRate;
use App\Models\ExtraBedOrder;
use App\Models\ServiceOrder;
use App\Models\ExtraBedOrderView;
use Illuminate\Support\Facades\Session;
use App\Models\Service;

class ExtraBedController extends Controller
{
    public function index()
    {
        $name = Session::get('name');
        if($name == null){
            return redirect()->route('login');
        }else{
        $rate = ExtraBedRate::first();
        return view('extrabed', ['rate' => $rate], ['username'=>$name]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'quantity' => 'required|numeric|min:1',
        ]);

 
        $serviceOrder = new ServiceOrder();
        $service = Service::where('title', 'LIKE', 'extra%')->first();
        $serviceId = $service ? $service->id : null;
        $serviceOrder->service_id = $serviceId; 
        $serviceOrder->booking_date_time = now();
        $serviceOrder->guest_id = Session::get('id'); 
        $serviceOrder->status = 6;     
        $serviceOrder->save();

        $bookingReferenceNumber = 'E' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
        $serviceOrder->booking_reference_number = $bookingReferenceNumber;
        $serviceOrder->save();

        $rate = ExtraBedRate::first();

        $order = new ExtraBedOrder();
        $order->service_order_id = $serviceOrder->id; 
        $order->quantity = $request->input('quantity');
        $order->rate_id = $rate->id;
        $order->rate = $rate->rate;
        $order->special_request = $request->input('specialRequest');
        $order->save();

        $amount = $rate->rate * $request->input('quantity');
        $serviceOrder->total_amount = $amount;
        $serviceOrder->save();

        return response()->json(['success' => true]);
    }

    public function show(){
        $name = Session::get('name');
        if($name == null){
            return redirect()->route('login');
        }else{
        $guestId = Session::get('id');
        $Orders = ExtraBedOrderView::where('guest_id', $guestId)
        ->orderByDesc('booking_date_time')
        ->get();

        return view('extrabedorders',['orders' => $Orders]);
        }
    }
}
