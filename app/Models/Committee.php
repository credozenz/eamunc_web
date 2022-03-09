<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $table = 'committees';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
