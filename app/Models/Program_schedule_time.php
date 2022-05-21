<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_schedule_time extends Model
{
    protected $table = 'program_schedule_times';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
