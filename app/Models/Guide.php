<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = ['name', 'age', 'experience', 'price', 'description', 'image'];

    public function bookings()
    {
        return $this->hasMany(GuidesBooking::class); // Assuming the model name is GuidesBooking
    }
}
