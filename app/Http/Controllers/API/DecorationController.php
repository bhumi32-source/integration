<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Models\DecorationBooking;
use App\Models\Decoration;
use App\Models\ServiceOrder;
use App\Models\DecorationBookingViewModel;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
// use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use App\Models\Facilities;


class DecorationController extends Controller
{
    public function book(Request $request, $id)
{
    try {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'booking_time_from' => 'required',
            'booking_time_to' => 'required',
            'booking_date' => 'required|date',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }


        // Create a new service order
    $serviceOrder = new ServiceOrder();
    $facility = Facilities::where('name', 'LIKE', '%decor%')->first();
    $facilityId = $facility ? $facility->id : null;
    $serviceOrder->facility_id = $facilityId; 
    $serviceOrder->booking_date_time = now();
    $serviceOrder->guest_id = Session::get('id');
    $serviceOrder->status = 1;
    $serviceOrder->save();

    $bookingReferenceNumber = 'D' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
    $serviceOrder->booking_reference_number = $bookingReferenceNumber;
    $serviceOrder->save();

        // Fetch decoration details based on $id
        $decoration = Decoration::findOrFail($id);

        // Create a new decoration booking
        $booking = new DecorationBooking();
        // Assign decoration details from fetched data
        $booking->decoration_id = $id;
        $booking->decoration_name = $decoration->name;
        $booking->price = $decoration->price;
        $booking->description = $decoration->description;
        $booking->booking_time_from = $request->input('booking_time_from');
        $booking->booking_time_to = $request->input('booking_time_to');
        $booking->booking_date = $request->input('booking_date');
        // Set other fields as needed
        $booking->service_order_id = $serviceOrder->id;
        $booking->save();

        // Redirect to the order decoration page
        return redirect('/order/decoration');
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Error while booking decoration: ' . $e->getMessage());
        // Return error response
        return response()->json(['success' => false, 'message' => 'An error occurred while processing your request.'], 500);
    }
}

public function cancelBooking($id)
    {
        try {
            // Find the booking by ID
            $booking = DecorationBooking::findOrFail($id);

            // Update the status to cancelled (assuming 'status' is an attribute in your model)
            $booking->status = 3; // Assuming '3' means cancelled

            // Save the changes
            $booking->save();

            // Return a success response
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Return an error response if an exception occurs
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }





public function getBookingTimeRange($id)
{
    // Fetch the decoration by ID
    $decoration = Decoration::findOrFail($id);

    // Return the booking time range as JSON
    return response()->json([
        'booking_time_from' => $decoration->booking_time_from,
        'booking_time_to' => $decoration->booking_time_to
    ]);
}



    
public function showOrders()
{
    $guestId = Session::get('id');
    
    // Fetch the bookings for the current guest from the view and apply sorting
    $bookings = DecorationBooking::where('guest_id', $guestId)
        ->orderBy('booking_date', 'desc') // Sort by booking_date in descending order
        ->orderBy('booking_time_to', 'desc') // Then by booking_time_to in descending order
        ->orderBy('booking_time_from', 'desc') // Then by booking_time_from in descending order
        ->get(); // Retrieve the sorted records

    $successMessage = 'Your order has been successfully placed!';

    // Pass the guestId, bookings, and successMessage to the view
    return view('order_decoration', compact('guestId', 'bookings', 'successMessage'));
}

public function getDescription($id)
{
    $decoration = Decoration::findOrFail($id);
    return response()->json(['description' => $decoration->description]);
}

public function updateDecorationView()
{
    // Fetch decorations data from the database
    $decorations = Decoration::all(); // Assuming you want to fetch all decorations
    // Pass the decorations data to the view
    return view('updateDecoration', compact('decorations'));
}

public function updateBookingTime(Request $request)
{
    try {
        // Validate the request data
        $validatedData = $request->validate([
            'booking_time' => 'required|string|max:100', // Adjust the max length according to your needs
        ]);

        // Get the new booking time from the request
        $newBookingTime = $validatedData['booking_time'];

        // Update the booking time in the database (assuming you have a Decoration model)
        $decoration = Decoration::first(); // Get the first decoration, assuming there's only one
        $decoration->booking_time = $newBookingTime;
        $decoration->save();

        // Return success response
        return response()->json([
            'message' => 'Booking time updated successfully.',
            'updated_time' => $newBookingTime, // Send the updated time in the response
        ], 200);
    } catch (\Exception $e) {
        // Log the error for debugging
        Log::error('Failed to update booking time: ' . $e->getMessage());

        return response()->json(['error' => 'Failed to update booking time. Please try again.'], 500);
    }
}


public function updateName(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
    ]);

    try {
        $decoration = Decoration::find($id);

        if (!$decoration) {
            return response()->json(['error' => 'Decoration not found'], 404);
        }

        $decoration->name = $request->input('name');
        $decoration->save();

        return response()->json(['message' => 'Name updated successfully'], 200);
    } catch (\Exception $e) {
        Log::error('Error updating name: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}

public function updateDescription(Request $request, $id)
{
    $request->validate([
        'description' => 'required|string',
    ]);

    try {
        $decoration = Decoration::find($id);

        if (!$decoration) {
            return response()->json(['error' => 'Decoration not found'], 404);
        }

        $decoration->description = $request->input('description');
        $decoration->save();

        return response()->json(['message' => 'Description updated successfully'], 200);
    } catch (\Exception $e) {
        Log::error('Error updating description: ' . $e->getMessage());
        return response()->json(['error' => 'Internal Server Error'], 500);
    }
}


}
