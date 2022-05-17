<?php

namespace App\Http\Controllers\App\Bureau;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helper\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\Countries;
use App\Models\User;
use View;
class BureauProfileController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','bureau_profile');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $country = Countries::where('id',$member->country_choice)->first();
      

        return view('app/bureau/bureau_profile', compact('guideline','committee','country','member'));
    }
}
