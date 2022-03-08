<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference_updates extends Model
{
    protected $table = 'conference_updates';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
