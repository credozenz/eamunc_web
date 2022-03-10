<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
use View;
class DashbordController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        
        View::share('routeGroup','dashbord');
       
    }

    public function getDashbord()
    {
        return view('admin/dashbord');
    }
}
