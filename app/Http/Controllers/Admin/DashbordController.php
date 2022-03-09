<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
class DashbordController extends Controller
{
    public function getDashbord()
    {
        return view('admin/dashbord');
    }
}
