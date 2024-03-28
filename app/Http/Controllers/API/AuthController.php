<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use App\Models\UserOtp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function index(){
        if(session('logged_in')) {
            return redirect()->route('dashboard');
        }

        return view('login');
    }
    public function sendOtp(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $lastSentTime = Session::get('otp_last_sent_time');
        if ($lastSentTime && Carbon::now()->diffInMinutes($lastSentTime) < 1) {
            return ;
        }

        $user = User::where('email', $request->email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $otp = rand(100000, 999999);

        $user_otp = new UserOtp;
        $user_otp->user_id = $user->id;
        $user_otp->email = $user->email;
        $user_otp->otp = $otp;
        $user_otp->expiration_time = Carbon::now()->addMinutes(2); 
        $user_otp->save();

        Session::put('email', $request->email);
        Session::put('name', $user->name);
        Session::put('id', $user->id);

        Session::put('otp_last_sent_time', Carbon::now());

        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'OTP sent successfully']);
    }

    public function resendOtp(Request $request)
    {
        $email = Session::get('email');

        $user = User::where('email', $email)->first();
        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $otp = rand(100000, 999999);

        $user_otp = new UserOtp;
        $user_otp->user_id = $user->id;
        $user_otp->email = $user->email;
        $user_otp->otp = $otp;
        $user_otp->expiration_time = Carbon::now()->addMinutes(2); 
        $user_otp->save();

        Mail::to($request->email)->send(new OtpMail($otp));

        return response()->json(['message' => 'New OTP sent successfully']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate([
            'otp' => 'required|numeric',
        ]);
        //$email = $request->email;

        $email = Session::get('email');
        if (!$email) {
            return response()->json(['error' => 'Session expired or invalid'], 422);
        }

        $user_otp = UserOtp::where('email', $email)->latest()->first();
        if (!$user_otp) {
            return response()->json(['error' => 'User not found or session expired'], 422);
        }

        if (Carbon::now()->gt($user_otp->expiration_time)) {
            return response()->json(['error' => 'OTP expired'], 422);
        }

        if ((int)$user_otp->otp !== (int)$request->otp) {
            return response()->json(['error' => 'Invalid OTP'], 422);
        }
        session(['logged_in' => true]);

        return response()->json(['message' => 'OTP verification successful', 'redirect' => route('dashboard')]);
    }
    public function logout(Request $request)
    {
        Session::forget('logged_in');
        Session::forget('email');
        Session::forget('name');

        return redirect()->route('login');
    }
    
}
