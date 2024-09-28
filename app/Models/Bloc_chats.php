<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Bloc_chats extends Model
{
    protected $table = 'bloc_chats';
    protected $dates = ['created_at','updated_at','deleted_at'];
    use SoftDeletes;
}
