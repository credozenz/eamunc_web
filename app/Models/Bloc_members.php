<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bloc_members extends Model
{
    protected $table = 'bloc_members';
    
    protected $dates = ['created_at','updated_at','deleted_at'];
    use SoftDeletes;
}
