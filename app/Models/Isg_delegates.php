<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isg_delegates extends Model
{
    protected $table = 'isg_delegates';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
