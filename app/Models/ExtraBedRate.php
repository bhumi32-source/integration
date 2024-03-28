<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExtraBedRate extends Model
{
    use HasFactory;
    protected $table = 'extra_bed_rate';
    protected $primaryKey = 'id';
}
