<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School_Delegates extends Model
{
    protected $table = 'school_delegates';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
