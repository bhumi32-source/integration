<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\DashboardController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
  //  return $request->user();
//});

Route::post('/send-otp', [AuthController::class, 'sendOtp'])->name("send-otp");
Route::post('/resend-otp', [AuthController::class, 'resendOtp'])->name("resend-otp");
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name("verify-otp");

Route::prefix('api')->group(function () {
    Route::get('/login', function () {
        return view('login');
    });

Route::get('/dashboard', [DashboardController::class, 'index'])->name("dashboard");
});