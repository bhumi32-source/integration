<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuidesBooking extends Model
{
    protected $table = 'guides_booking'; // Specify the correct table name

    protected $fillable = ['guide_id', 'name', 'age', 'experience', 'price', 'description', 'status']; // Remove 'user_id'

    public function guide()
    {
        return $this->belongsTo(Guide::class);
    }
}
