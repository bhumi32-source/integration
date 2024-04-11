<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuidesBookingViewModel extends Model
{
    protected $table = 'guides_booking_view';

    protected $fillable = [
        'guide_id',
        'name',
        'age',
        'experience',
        'image',
        'price',
        'description',
        'booking_status',
        'date',
        'time',
        'booking_reference_number',
        'service_id',
        'booking_date_time',
        'guest_id',
        'total_amount',
        'payment_status',
        'status',
    ];

    // Optionally define relationships or additional properties here
}


