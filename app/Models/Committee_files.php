<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee_files extends Model
{
    protected $table = 'committee_files';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
