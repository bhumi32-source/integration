<?php

namespace App\Http\Controllers\API;

use App\Models\Guide;
use App\Models\GuidesBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Models\Facilities;
use App\Models\GuidesBookingViewModel;
use App\Models\ServiceOrder;
use App\Models\Booking; // Assuming 'Booking' is your model


class GuideController extends Controller
{


    public function book(Request $request, $id)
    {
        try {
            // Validate request data (customize validation rules as needed)
            $validatedData = $request->validate([
                'guide_id' => 'required',
                'name' => 'required|string|max:255',
                'age' => 'required|integer',
                'experience' => 'required|string|max:255',
                'image' => 'nullable|string|max:255', // Assuming image is a URL or filename
                'price' => 'required|integer', // Ensure price is validated as an integer
                'description' => 'required|string',
                'date' => 'required|date',
                'time' => 'required|date_format:H:i', // Validate time format (24-hour)
            ]);
    
            // Create a new service order
            $serviceOrder = new ServiceOrder();
            $facility = Facilities::where('name', 'LIKE', '%guide%')->first();
            $facilityId = $facility ? $facility->id : null;
            $serviceOrder->facility_id = $facilityId;
            $serviceOrder->booking_date_time = now();
            $serviceOrder->guest_id = Session::get('id');
            $serviceOrder->status = 1;
            $serviceOrder->save();
    
            // Generate booking reference number
            $bookingReferenceNumber = 'G' . str_pad($serviceOrder->id, 6, '0', STR_PAD_LEFT);
            $serviceOrder->booking_reference_number = $bookingReferenceNumber;
            $serviceOrder->save();
    
            // Create a new instance of GuidesBooking model
            $booking = new GuidesBooking();
    
            // Assign values from the validated request data to the model
            $booking->guide_id = $validatedData['guide_id'];
            $booking->name = $validatedData['name'];
            $booking->age = $validatedData['age'];
            $booking->experience = $validatedData['experience'];
            $booking->image = $validatedData['image'] ?? null;
            $booking->price = $validatedData['price'];
            $booking->description = $validatedData['description'];
            // $booking->status = 'pending';
            $booking->date = $validatedData['date'];
            $booking->time = $validatedData['time'];
    
            // Assign the service_order_id from the retrieved ServiceOrder
            $booking->service_order_id = $serviceOrder->id;
    
            // Save the booking
            $booking->save();
    
            // Redirect to the book_guide_details route with success message
            return redirect()->route('book_guide_details')->with('success', 'Booking successful.');
        } catch (\Exception $e) {
            Log::error("Error booking guide: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Failed to book guide.');
        }
    }

    public function cancelBooking($guideId)
    {
        try {
            // Update the status in guides_booking_view table
            $affectedRows = DB::table('guides_booking_view')
                ->where('guide_id', $guideId)
                ->update(['status' => 3]);
    
            if ($affectedRows > 0) {
                // Return success response if rows were updated
                return response()->json(['success' => true]);
            } else {
                // Return error response if no rows were updated (guide_id not found)
                return response()->json(['success' => false, 'message' => 'Guide booking not found'], 404);
            }
        } catch (\Exception $e) {
            // Log the exception for debugging
            Log::error('Error cancelling booking: ' . $e->getMessage());
    
            // Return error response with internal server error status
            return response()->json(['success' => false, 'message' => 'Internal Server Error'], 500);
        }
    }


    /**
     * Show the form for booking a guide.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function bookGuide()
    {
        // Fetch the guides from the database
        $guides = Guide::all(); // Assuming you're using Eloquent and the Guide model

        // Pass the $guides variable to the view
        return view('book_guide', ['guides' => $guides]);
    }

    public function show()
    {
        // Retrieve guides from the database or any other source
        $guides = Guide::all(); // Assuming you want to retrieve all guides
        
        // Pass the $guides variable to the view
        return view('book_guide', compact('guides'));
    }


public function showAll()
{
    try {
        // Retrieve guest ID from session
        $guestId = Session::get('id');

        // Fetch all the bookings from guides_booking_view associated with the guest
        $bookings = GuidesBookingViewModel::where('guest_id', $guestId)
            ->orderByRaw('CONCAT(date, " ", time) DESC')
            ->get();

        // Pass the data to the view
        return view('book_guide_details', compact('bookings'));
    } catch (\Exception $e) {
        // Log and handle the exception
        \Log::error("Error fetching guide bookings: {$e->getMessage()}");
        return redirect()->back()->with('error', 'Failed to fetch guide bookings.');
    }
}


public function showBookingDescription($id)
    {
        try {
            // Find the guide by ID
            $guide = Guide::findOrFail($id);

            // Retrieve the first booking associated with this guide (assuming one-to-many relationship)
            $booking = $guide->bookings()->first(); // Assuming you want the first booking

            if (!$booking) {
                throw new \Exception('Booking not found for this guide.');
            }

            // Return the booking details as JSON response
            return response()->json([
                'success' => true,
                'booking' => $booking
            ]);
        } catch (\Exception $e) {
            // Handle not found exception or other errors
            return response()->json([
                'success' => false,
                'message' => $e->getMessage() // Display the error message
            ], 404);
        }
}



public function getBookingDescription($guide_id)
    {
        // Retrieve the guide based on the guide_id
        $guide = Guide::where('guide_id', $guide_id)->first();

        if (!$guide) {
            return response()->json(['error' => 'Guide not found'], 404);
        }

        // Return the description
        return response()->json(['description' => $guide->description]);
    }





}
