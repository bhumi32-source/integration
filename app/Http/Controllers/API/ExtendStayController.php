<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ServiceOrder;
use App\Models\ExtendStay;
use App\Models\ExtendStayView;
use App\Models\Service;
use Illuminate\Support\Facades\Session;

class ExtendStayController extends Controller
{
    public function index()
    {
        $name = Session::get('name');
        if($name == null){
            return redirect()->route('login');
        }else{
        return view('extend_stay', ['username'=>$name]);
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'=> 'required|date',
           
        ]);

        $serviceOrder = new ServiceOrder();
        $service = Service::where('title', 'LIKE', 'extend%')->first();
        $serviceId = $service ? $service->id : null;
        $serviceOrder->service_id = $serviceId;
        $serviceOrder->booking_date_time = now();
        $serviceOrder->guest_id = Session::get('id'); 
        $serviceOrder->status = 6; 
        $serviceOrder->save();

 
        $bookingReferenceNumber = 'ES' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
        $serviceOrder->booking_reference_number = $bookingReferenceNumber;
        $serviceOrder->save();


        $extendedStayBooking = new ExtendStay();
        $extendedStayBooking->service_order_id = $serviceOrder->id; 
        $extendedStayBooking->extend_till_date = $request->input('date');
        $extendedStayBooking->special_request = $request->input('specialRequest');

        $extendedStayBooking->save();

        return response()->json(['success' => true]);
    }

    public function show(){
        $name = Session::get('name');
        if($name == null){
            return redirect()->route('login');
        }else{
        $guestId = Session::get('id');
        $Orders = ExtendStayView::where('guest_id', $guestId)
        ->orderByDesc('booking_date_time')
        ->get();

        return view('extendstayorders',['orders' => $Orders]);
        }
    }

    public function cancelOrder($id)
        {
            $serviceOrder = ServiceOrder::findOrFail($id);
            $serviceOrder->status = 3; 
            $serviceOrder->save();
        
            return response()->json(['success' => true, 'message' => 'Order successfully cancelled']);
        }
}

