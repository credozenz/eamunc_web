<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program_schedule extends Model
{
    protected $table = 'program_schedules';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
