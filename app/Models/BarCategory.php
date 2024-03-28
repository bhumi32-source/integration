<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','bar_cat_id'
    ];
    public function items()
    {
        return $this->hasMany(BarItem::class, 'bar_cat_id'); // Assuming 'category_id' is the foreign key in the BarItem model
    }
}
