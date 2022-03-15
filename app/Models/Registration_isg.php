<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration_isg extends Model
{
    protected $table = 'registration_isgs';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
