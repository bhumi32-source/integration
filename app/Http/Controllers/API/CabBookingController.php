<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CabBooking;
use App\Models\ServiceOrder;
use App\Models\CabOrderView;
use Carbon\Carbon;
use App\Models\Facilities;
use Illuminate\Support\Facades\Session;
use App\Rules\TimeRule;

class CabBookingController extends Controller
{
    public function index(){
        $name = Session::get('name');
        return view('cabbooking', ['username'=>$name]);
    }

    public function store(Request $request)
{
    $rules = [
        'tripType' => 'required|in:OneWay,RoundTrip,Rentals',
    ];

    $tripType = $request->input('tripType');

    if ($tripType === 'OneWay') {
        $rules += [
            'pickupLocationOneWay' => 'required|string',
            'dropLocationOneWay' => 'required|string',
            'pickupDateOneWay' => 'required|date|after_or_equal:today',
            'pickupTimeOneWay' => ['required', new TimeRule(120)],
            'numberOfPersonsOneWay' => 'required|integer|min:1',
            'specialRequestOneWay' => 'nullable|string',
        ];
    } elseif ($tripType === 'RoundTrip') {
        $rules += [
            'pickupLocationRoundTrip' => 'required|string',
            'dropLocationRoundTrip' => 'required|string',
            'pickupDateRoundTrip' => 'required|date|after_or_equal:today',
            'pickupTimeRoundTrip' => ['required', new TimeRule(120)],
            'numberOfPersonsRoundTrip' => 'required|integer|min:1',
            'specialRequestRoundTrip' => 'nullable|string',
        ];
    } elseif ($tripType === 'Rentals') {
        $rules += [
            'pickupLocationRentals' => 'required|string',
            'pickupDateRentals' => 'required|date|after_or_equal:today',
            'pickupTimeRentals' => ['required', new TimeRule(120)],
            'numberOfPersonsRentals' => 'required|integer|min:1',
            'numberOfHoursRentals' => 'required|integer|min:0',
            'specialRequestRentals' => 'nullable|string',
        ];
    }

    $request->validate($rules);

    // Create a new service order
    $serviceOrder = new ServiceOrder();
    $facility = Facilities::where('name', 'LIKE', 'cab%')->first();
    $facilityId = $facility ? $facility->id : null;
    $serviceOrder->facility_id = $facilityId; 
    $serviceOrder->booking_date_time = now();
    $serviceOrder->guest_id = Session::get('id');
    $serviceOrder->status = 1;
    $serviceOrder->save();

    $bookingReferenceNumber = 'C' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
    $serviceOrder->booking_reference_number = $bookingReferenceNumber;
    $serviceOrder->save();

    // Extract time from request and convert it to 24-hour format
    $pickupTime = $this->convertTo24HourFormat($request->input('pickupTime'.$tripType));

    // Create a new CabBooking instance and save it
    $cabBooking = new CabBooking();
    $cabBooking->trip_type = $tripType;
    $cabBooking->pickup_location = $request->input('pickupLocation'.$tripType);
    $cabBooking->drop_location = $request->input('dropLocation'.$tripType);
    $cabBooking->pickup_date = $request->input('pickupDate'.$tripType);
    $cabBooking->pickup_time = $pickupTime; // Store time in 24-hour format
    $cabBooking->no_of_persons = $request->input('numberOfPersons'.$tripType);
    $cabBooking->rental_hours = $request->input('numberOfHours'.$tripType, null); 
    $cabBooking->special_request = $request->input('specialRequest'.$tripType, null); 
    $cabBooking->service_order_id = $serviceOrder->id; 
    $cabBooking->save();

    return redirect()->route("cab-order-list");
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
            $UpcomingOrders = CabOrderView::where('guest_id', $guestId)
                ->where(function ($query) {
                    $query->where('pickup_date', '>', now()->toDateString())
                        ->orWhere(function ($query) {
                            $query->where('pickup_date', '=', now()->toDateString())
                                    ->where('pickup_time', '>=', now()->toTimeString());
                        });
                })
                ->orderBy('pickup_date')
                ->orderBy('pickup_time')
                ->get();

                $AllOrders = CabOrderView::where('guest_id', $guestId)
                ->orderByDesc('pickup_date')
                ->orderByDesc('pickup_time')
                ->get();
 
                return view('caborders', [
                    'upcomingorders' => $UpcomingOrders,
                    'allorders' => $AllOrders
                ]);
    }


    public function cancelOrder($id)
    {
        $serviceOrder = ServiceOrder::findOrFail($id);
        $serviceOrder->status = 3; 
        $serviceOrder->save();
    
        return redirect()->route("cab-order-list");
    }
    

}
