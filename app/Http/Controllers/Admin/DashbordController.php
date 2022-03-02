<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashbordController extends Controller
{
    public function getDashbord()
    {
        return view('admin/dashbord');
    }
}
