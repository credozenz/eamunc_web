<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alumni_registration extends Model
{
    protected $table = 'alumni_registration';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
