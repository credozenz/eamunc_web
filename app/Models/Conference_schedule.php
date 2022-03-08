<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference_schedule extends Model
{
    protected $table = 'conference_schedules';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
