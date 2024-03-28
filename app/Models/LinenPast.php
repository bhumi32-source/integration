<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinenPast extends Model
{
    use HasFactory;
 protected $table = 'linen_past';
    protected $fillable = [
       'order_id', 'name', 'image_path', 'quantity', 'price'
    ];

    // You can define relationships or additional methods here if needed
}
