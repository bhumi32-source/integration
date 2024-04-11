<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = 'guides'; // Assuming your table name is 'bookings'
    protected $primaryKey = 'id';
    public $timestamps = false;

    // Add any relationships or additional methods here
}
