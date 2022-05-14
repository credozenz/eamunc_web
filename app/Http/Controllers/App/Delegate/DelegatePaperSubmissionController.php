<?php

namespace App\Http\Controllers\App\Delegate;

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
use App\Models\User;
use View;

class DelegatePaperSubmissionController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','delegate_paper_submission');
       
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


        return view('app/delegate/paper_submission', compact('guideline','committee','committee_member'));
    }
}
