<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Live extends Model
{
    protected $table = 'lives';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
