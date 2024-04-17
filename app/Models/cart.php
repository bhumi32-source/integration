<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
     protected $table = 'cart';
     protected $primaryKey = 'id';
    
  protected $fillable = ['name', 'description', 'price', 'image_path', 'quantity','guest_id'];

     public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
