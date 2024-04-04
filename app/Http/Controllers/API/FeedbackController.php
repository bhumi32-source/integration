<?php
namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {

        $guestId = Session::get('id');

        $feedback = new Feedback();
        $feedback->guest_id = $guestId; // Store the user ID
        $feedback->star_ratings = $request->input('star');
        $feedback->comments = $request->input('comments');
        $feedback->save();

        return response()->json(['message' => 'Feedback submitted successfully'], 200);
    }
}
