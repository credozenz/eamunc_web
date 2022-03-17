<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\School_Delegates;
use App\Models\Isg_delegates;
use App\Models\Committee;
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

        $Isg_count = Isg_delegates::where('deleted_at', null)->count(); 
        $scoolDelecount = School_Delegates::where('deleted_at', null)->count();  
        $cmtecount = Committee::where('deleted_at', null)->count(); 
        $schoolcount = School::where('deleted_at', null)->count(); 

        $delegate = Isg_delegates::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(10); 

        return view('admin/dashbord', compact('delegate','Isg_count','scoolDelecount','cmtecount','schoolcount'));
    }
}
