<?php
namespace App\Http\Controllers\API;
use App\Models\Guide;
use App\Models\GuidesBooking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\Controller;

class BookGuideController extends Controller
{
    public function book(Request $request)
    {
        try {
            // Retrieve the guide details from the request
            $guideId = $request->input('guide_id');
            $guide = Guide::findOrFail($guideId);

            // Create a new booking
            $booking = new GuidesBooking();
            $booking->guide_id = $guideId;
            $booking->user_id = auth()->id(); // Assuming you're using Laravel's authentication
            $booking->image = $guide->image;
            $booking->name = $guide->name;
            $booking->age = $guide->age;
            $booking->experience = $guide->experience;
            $booking->price = $guide->price;
            $booking->description = $guide->description;
            $booking->status = 'pending';
            $booking->save();

            // Redirect to show the booking details
            return redirect()->route('bookings.show', $booking->id)->with('success', 'Booking successful!');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error("Error booking guide: {$e->getMessage()}");
            return redirect()->back()->with('error', 'Failed to book guide.');
        }
    }

    // Other controller methods...
}
