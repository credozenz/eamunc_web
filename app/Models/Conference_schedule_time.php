<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference_schedule_time extends Model
{
    protected $table = 'conference_schedule_times';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
