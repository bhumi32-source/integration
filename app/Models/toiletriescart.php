<?php
namespace App\Models;
use App\Models\ToiletriesCart;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToiletriesCart extends Model
{
    use HasFactory;
    
    protected $table = 'toiletries_cart';
    protected $primaryKey = 'id';

    protected $fillable = ['toiletries_id','name', 'description', 'image_path', 'quantity','guest_id'];

    public function toiletry()
    {
        return $this->belongsTo(Toiletries::class, 'toiletries_id', 'toiletries_id');
    }
}
