<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaBooking extends Model
{
    use HasFactory;
    protected $table = 'spa_booking';
    protected $primaryKey = 'id';
}
