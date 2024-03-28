<?php

// File: app\Models\Item.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image_path', 'category_id','is_menu_item'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    
}
