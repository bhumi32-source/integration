<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomCleaning extends Model
{
    use HasFactory;
    protected $table = 'room_cleaning_order';
    protected $primaryKey = 'id';
}
