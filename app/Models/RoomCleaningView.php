<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCleaningView extends Model
{
    use HasFactory;
    protected $table = 'room_cleaning_order_view';
    protected $primaryKey = null;
}
