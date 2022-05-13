<?php

namespace App\Http\Controllers\App\Bureau;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use View;
class BureauDashbordController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        
        View::share('routeGroup','bureau_dashbord');
       
    }

    public function getDashbord()
    {

      
        return view('app/bureau/dashbord');
    }
}
