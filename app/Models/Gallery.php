<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $table = 'galleries';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
