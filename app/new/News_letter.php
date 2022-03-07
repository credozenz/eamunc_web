<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News_letter extends Model
{
    protected $table = 'newsletters';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
