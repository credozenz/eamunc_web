<?php

namespace App\Http\Controllers\App\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helpers\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\Vienna_formula;
use App\Models\User;
use View;

class DelegateViennaFormulaController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','delegate_vienna_formula');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $vienna = Vienna_formula::where('committe_id',$committee->id)->first();


        return view('app/delegate/vienna_formula', compact('committee','vienna'));
    }
}
