<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuidesBooking extends Model
{
    protected $table = 'guides_booking';
    protected $fillable = [
        'guide_id', 'name', 'age', 'experience', 'image', 'price', 'description', 'status', 'date', 'time'
    ];
}
