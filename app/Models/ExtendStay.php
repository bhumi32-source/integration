<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtendStay extends Model
{
    use HasFactory;
    protected $table= 'extended_stay_booking';
    protected $primaryKey = 'id';
}
