<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gallery extends Model
{
    protected $table = 'galleries';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
