<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculties_messages extends Model
{
    protected $table = 'faculties_messages';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
