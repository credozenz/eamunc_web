<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Host_schools extends Model
{
    protected $table = 'host_schools';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
