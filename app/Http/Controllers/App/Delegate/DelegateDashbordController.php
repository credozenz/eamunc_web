<?php

namespace App\Http\Controllers\App\Delegate;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteIndexes;
use App\Helper\WebAppHelper;
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
                                ->join('schools', 'students.school_id', '=', 'schools.id')
                                ->select('students.*', 'schools.name as school_name', 'users.role')
                                ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $committee->id)
                                ->paginate(300);


        return view('app/delegate/dashbord', compact('guideline','committee','committee_member'));
    }
}