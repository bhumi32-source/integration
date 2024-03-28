<?php
// File: app/Models/PastOrder.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PastOrder extends Model
{
    use HasFactory;

    protected $fillable = [
    'order_id',
    'name',
    'description',
    'price',
    'image_path',
    'quantity',
    'created_at',
    'updated_at',
];
   
    // You can define relationships or other methods here if needed
}
