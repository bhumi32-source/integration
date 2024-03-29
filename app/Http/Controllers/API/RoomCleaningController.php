<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\RoomCleaning;
use App\Models\ServiceOrder;
use App\Models\RoomCleaningView;
use App\Rules\TimeRule;
use App\Models\Service;

class RoomCleaningController extends Controller
{
    public function index(){
        $name = Session::get('name');
        return view ('roomcleaning', ['username'=>$name]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'date'=>'required|date|after_or_equal:today',
            'time' => [
                'required',
                new TimeRule(10), 
                'after_or_equal:08:00am', 
                'before_or_equal:10:30pm', 
            ],
        ]);

        $time12h = $request->input('time');
        $time24h = $this->convertTo24HourFormat($time12h);

        $serviceOrder = new ServiceOrder();
        $service = Service::where('title', 'LIKE', 'room%')->first();
        $serviceId = $service ? $service->id : null;
        $serviceOrder->service_id = $serviceId; 
        $serviceOrder->booking_date_time = now();
        $serviceOrder->guest_id = Session::get('id');
        $serviceOrder->status = 6;
        $serviceOrder->save();

        $bookingReferenceNumber = 'N' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
        $serviceOrder->booking_reference_number = $bookingReferenceNumber;
        $serviceOrder->save();

        $roomcleaning = new RoomCleaning();
        $roomcleaning->date = $request->input('date');
        $roomcleaning->time = $time24h; 
        $roomcleaning->special_request = $request->input('specialRequest');
        $roomcleaning->service_order_id = $serviceOrder->id;
        $roomcleaning->save();

    
        return response()->json(['success' => true]);
    } 

 
    private function convertTo24HourFormat($time12h)
    {

    preg_match('/^(\d{1,2}):(\d{2})(am|pm)$/i', $time12h, $matches);

    if (count($matches) != 4) {
        $hours = 0;
        $minutes = 0;
        $period = 'am';
    } else {
        $hours = (int)$matches[1];
        $minutes = (int)$matches[2];
        $period = strtolower($matches[3]);
    }

    if ($period === 'pm' && $hours !== 12) {
        $hours += 12;
    } elseif ($period === 'am' && $hours === 12) {
        $hours = 0;
    }

    $formattedHours = str_pad($hours, 2, '0', STR_PAD_LEFT);
    $formattedMinutes = str_pad($minutes, 2, '0', STR_PAD_LEFT);

    $time24h = $formattedHours . ':' . $formattedMinutes;

    return $time24h;
}

    
public function show()
{
    $guestId = Session::get('id');
    $UpcomingOrders = RoomCleaningView::where('guest_id', $guestId)
        ->where(function ($query) {
            $query->where('date', '>', now()->toDateString())
                ->orWhere(function ($query) {
                    $query->where('date', '=', now()->toDateString())
                            ->where('time', '>=', now()->toTimeString());
                });
        })
        ->orderBy('date')
        ->orderBy('time')
        ->get();

        $AllOrders = RoomCleaningView::where('guest_id', $guestId)
        ->orderByDesc('date')
        ->orderByDesc('time')
        ->get();

        return view('roomcleaningorder', [
            'upcomingorders' => $UpcomingOrders,
            'allorders' => $AllOrders
        ]);
}
    
/*public function show()
{
    $guestId = Session::get('id');
        $AllOrders = RoomCleaningView::where('guest_id', $guestId)
        ->orderBy('date')
        ->orderBy('time')
        ->get();

        return view('roomcleaningorder', [
            'allorders' => $AllOrders
        ]);
}
*/
        public function cancelOrder($id)
        {
            $serviceOrder = ServiceOrder::findOrFail($id);
            $serviceOrder->status = 3; 
            $serviceOrder->save();
        
            return redirect()->route("room-cleaning-list");
        }
        
    
    } 
    

