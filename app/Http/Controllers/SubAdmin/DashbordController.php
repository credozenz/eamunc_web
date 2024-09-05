<?php

namespace App\Http\Controllers\SubAdmin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Students;
use App\Models\User;
use App\Models\Committee;
use View;
class DashbordController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        
        View::share('routeGroup','dashbord');
       
    }
    public function log_out()
    {
        Session::flush();
       return redirect('/subadmin');
    }
    public function getDashbord()
    {
        $cmtecount = Committee::where('deleted_at', null)->count(); 
        $schoolcount = School::where('deleted_at', null)->count(); 



        return view('subadmin/dashbord', compact('cmtecount','schoolcount'));
    }









}
