<?php

namespace App\Http\Controllers\App\Delegate;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
use App\Helpers\WebAppHelper;
use App\Models\School;
use App\Models\Committee;
use App\Models\User;
use View;
class DelegateDashbordController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();
        
        View::share('routeGroup','delegate_dashbord');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();
        
        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $committee_member = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->join('countries', 'countries.id', '=', 'students.country_choice')
                                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                                ->select('students.*', 'schools.name as school_name', 'users.role','users.avatar','countries.name as cntry_name')
                                ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $committee->id)
                                ->paginate(300);


        return view('app/delegate/dashbord', compact('guideline','committee','committee_member'));
    }

    public function guideline()
    {
        View::share('routeGroup','delegate_guideline');

        $member = WebAppHelper::getLogMember();
        
        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $committee_member = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                                ->select('students.*', 'schools.name as school_name', 'users.role','users.avatar')
                                ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $committee->id)
                                ->paginate(300);


        return view('app/delegate/guideline', compact('guideline','committee','committee_member'));
    }
}
