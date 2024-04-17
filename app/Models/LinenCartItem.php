<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinenCartItem extends Model
{
    use HasFactory;
protected $table = 'linen_cart';

    protected $fillable = [
        'linen_id', 'name', 'quantity', 'image_path', 'guest_id'];

    // Define any relationships or additional methods as needed
}
