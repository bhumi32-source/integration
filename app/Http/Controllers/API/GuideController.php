<?php

namespace App\Http\Controllers\API;

use App\Models\Guide;
use App\Models\GuidesBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GuideController extends Controller
{

    public function cancelBooking(Request $request, $id)
{
    if ($request->isMethod('post')) {
        try {
            // Find the booking by ID
            $booking = GuidesBooking::findOrFail($id);
            
            // Update the status to "Cancelled"
            $booking->status = 'Cancelled';
            $booking->save();
            
            return response()->json(['message' => 'Booking cancelled successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to cancel booking'], 500);
        }
    } else {
        // Handle GET request if needed
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

    /**
     * 
     * 
     * Show details of a specific guide.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show()
    {
        // Retrieve guides from the database or any other source
        $guides = Guide::all(); // Assuming you want to retrieve all guides
        
        // Pass the $guides variable to the view
        return view('book_guide', compact('guides'));
    }

    /**
     * Show all bookings made for guides.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function showAll()
    {
        try {
            // Fetch all the bookings from guides_booking along with their associated guide details
            $bookings = GuidesBooking::with('guide')->get();

            // Pass the data to the view
            return view('book_guide_details', ['bookings' => $bookings]);
        } catch (\Exception $e) {
            Log::error("Error fetching all guide bookings: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Failed to fetch guide bookings.');
        }
    }
    /**
     * Book a guide.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */

public function book(Request $request, $id)
{
    try {
        // Create a new instance of GuidesBooking model
        $booking = new GuidesBooking();

        // Assign values from the request to the model
        $booking->guide_id = $request->input('guide_id');
        $booking->name = $request->input('name');
        $booking->age = $request->input('age');
        $booking->experience = $request->input('experience');
        $booking->image = $request->input('image');
        $booking->price = $request->input('price');
        $booking->description = $request->input('description');
        $booking->status = 'pending';

        // Save the booking
        $booking->save();

        // Redirect to the book_guide_details route with success message
        return redirect()->route('book_guide_details')->with('success', 'Booking successful.');
    } catch (\Exception $e) {
        Log::error("Error booking guide: {$e->getMessage()}");
        return redirect()->back()->with('error', 'Failed to book guide.');
    }
}


}
