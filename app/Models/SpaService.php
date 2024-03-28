<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpaService extends Model
{
    use HasFactory;
    protected $table = 'spa_service_type';
    protected $primaryKey = 'id';
}
