<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blocs extends Model
{
    protected $table = 'blocs';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
