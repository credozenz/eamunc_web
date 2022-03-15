<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback_ans extends Model
{
    protected $table = 'feedback_answer';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
