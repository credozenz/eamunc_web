<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paper_submission extends Model
{
    protected $table = 'paper_submissions';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
