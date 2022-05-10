<?php

namespace App\Http\Controllers\App\Delegate;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\School_Delegates;
use App\Models\Isg_delegates;
use App\Models\Committee;
use View;
class DelegateDashbordController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        
        View::share('routeGroup','delegate_dashbord');
       
    }

    public function getDashbord()
    {

      
        return view('app/delegate/dashbord');
    }
}
