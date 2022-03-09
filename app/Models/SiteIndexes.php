<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SiteIndexes extends Model
{
    protected $table = 'site_indexes';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
