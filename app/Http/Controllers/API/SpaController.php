<?php
namespace App\Http\Controllers\API;

use Illuminate\Support\Facades\Log;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SpaPackage;
use App\Models\SpaService;
use Illuminate\Support\Facades\Session;
use App\Models\SpaBooking;
use App\Models\SpaOrderView;
use App\Models\ServiceOrder;
use App\Models\Facilities;
use App\Rules\TimeRule;


class SpaController extends Controller
{
    public function index()
{
    $username = Session::get('name');
    
    $packages = SpaPackage::all();
    $services = SpaService::all();
    return view('spa', ['packages' => $packages, 'services' => $services, 'username' => $username]);
}


    public function store(Request $request)
{
    try {
        $request->validate([
            'date' => 'required|date|after_or_equal:today',
            'time' => [
                'required',
                new TimeRule(30), 
                'after_or_equal:10:00am', 
                'before_or_equal:10:30pm', 
            ],
            'special_request' => 'nullable|string',
            'selected_items' => 'required|array',
            'selected_items.*.type' => 'required|string|in:package,service',
            'selected_items.*.id' => 'required|integer',
            'no_of_persons' => 'required|array',
            'no_of_persons.*' => 'required|integer|min:1',
        ]);
        
        
        $serviceOrder = new ServiceOrder();
        $facility = Facilities::where('name', 'LIKE', 'spa%')->first();
        $facilityId = $facility ? $facility->id : null;
        $serviceOrder->facility_id = $facilityId;
        $serviceOrder->booking_date_time = now();
        $serviceOrder->guest_id = Session::get('id');
        $serviceOrder->status = 1;
        $serviceOrder->save();

        $bookingReferenceNumber = 'S' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);

        $serviceOrder->booking_reference_number = $bookingReferenceNumber;
        $serviceOrder->save();

        $totalAmount = 0; 

        foreach ($request->input('selected_items') as $key => $item) {
            $type = $item['type'];
            $id = $item['id'];
            $noOfPersons = $request->input('no_of_persons')[$key];

            $spaBooking = new SpaBooking();
            $spaBooking->date = $request->input('date');
            // Convert time to 24-hour format
            $spaBooking->time = $this->convertTo24HourFormat($request->input('time'));
            $spaBooking->service_order_id = $serviceOrder->id;
            $spaBooking->special_request = $request->input('special_request');
            $spaBooking->no_of_persons = $noOfPersons;

            if ($type === 'package') {
                $spaBooking->spa_package_id = $id;
                $package = SpaPackage::where('package_id', $id)->firstOrFail();
                $spaBooking->duration = $package->total_duration;
                $spaBooking->amount = $package->package_price * $noOfPersons;
            } elseif ($type === 'service') {
                $spaBooking->spa_service_type_id = $id;
                $service = SpaService::findOrFail($id);
                $spaBooking->duration = $service->duration;
                $spaBooking->amount = $service->price * $noOfPersons;
            }

            $spaBooking->save();
            $totalAmount += $spaBooking->amount;
        }

        $serviceOrder->total_amount = $totalAmount;
        $serviceOrder->save();

        return redirect()->route('spa-order-list');
    } catch (\Exception $e) {
        Log::error('Error occurred while processing request: ' . $e->getMessage());
        return response()->json(['error' => 'An error occurred while processing your request. Please try again later.'], 500);
    }
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
    
    $UpcomingOrders = SpaOrderView::where('guest_id', $guestId)
    ->where(function ($query) {
        $query->where('date', '>', now()->toDateString())
              ->orWhere(function ($query) {
                  $query->where('date', '=', now()->toDateString())
                        ->where('time', '>=', now()->toTimeString());
              });
    })
    ->orderBy('date')
    ->orderBy('time')
    ->get()
    ->groupBy('booking_reference_number');

    $AllOrders = SpaOrderView::where('guest_id', $guestId)
    ->orderByDesc('date')
    ->orderByDesc('time')
    ->get()
    ->groupBy('booking_reference_number');

        return view('spaorders', [
            'upcomingorders' => $UpcomingOrders,
            'allorders' => $AllOrders
        ]);
}


public function cancelOrder($id)
        {
            $serviceOrder = ServiceOrder::findOrFail($id);
            $serviceOrder->status = 3; 
            $serviceOrder->save();
        
            return redirect()->route("spa-order-list");
        }

}
