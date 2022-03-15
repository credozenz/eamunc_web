<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback_qsn extends Model
{
    protected $table = 'feedback_question';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
