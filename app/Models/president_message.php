<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class president_message extends Model
{
    protected $table = 'president_messages';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
