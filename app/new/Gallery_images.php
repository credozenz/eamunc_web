<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery_images extends Model
{
    protected $table = 'gallery_images';
    protected $dates = ['created_at','updated_at','deleted_at'];
}
