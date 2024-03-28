<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Linen extends Model
{
    use HasFactory;

    protected $table = 'linen'; // Define the table name

    protected $primaryKey = 'linen_id'; // Define the primary key

    protected $fillable = ['name', 'image_path']; // Define fillable attributes

    // Other model logic, such as relationships, scopes, etc., can be added here
}
