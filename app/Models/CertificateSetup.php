<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificateSetup extends Model
{
    protected $table = 'certificate_setup';
    protected $dates = ['created_at','updated_at','deleted_at'];
}