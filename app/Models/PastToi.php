<?php
// app/Models/PastToi.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PastToi extends Model
{
     protected $table = 'past_toi';
    protected $fillable = [
        'id',
        'name',
        'quantity',
        'image_path',
        'order_id',
        'guest_id'
    ];
}
