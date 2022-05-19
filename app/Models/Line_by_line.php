<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Line_by_line extends Model
{
    protected $table = 'line_by_line';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
