<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Committee_member extends Model
{
    protected $table = 'committee_members';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
