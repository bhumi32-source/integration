<?php

// app\Models\toiletries.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class toiletries extends Model
{
   protected $table = 'toiletries'; // Specify the table name in the database
 protected $primaryKey = 'toiletries_id';
    public $incrementing = true;
  
    protected $fillable = [
        'toiletries_id',
        'name',
        'quantity',
        'image_path',
       
    ];


}
