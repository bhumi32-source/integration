<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DecorationBooking extends Model
{
    use HasFactory;

    protected $table = 'decoration_bookings';

    protected $fillable = [
        'decoration_id',
        'decoration_name',
        'price',
        'booking_time_from',
        'booking_time_to',
        'booking_date',
        'status',
        'action',
        'description'
    ];

    // Here, 'status' will be set to 'pending' by default
    protected $attributes = [
        'status' => 'pending'
    ];
}
