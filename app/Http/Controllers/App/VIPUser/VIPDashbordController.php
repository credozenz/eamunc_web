<?php

namespace App\Http\Controllers\App\VIPUser;

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
use App\Models\User;
use View;
use Illuminate\Support\Facades\Auth;
class VIPDashbordController extends Controller
{

    public function __construct()
    {
        
        View::share('routeGroup','vipuser_dashbord');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();
       
        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $committee_member = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                                ->select('students.*', 'schools.name as school_name', 'users.role', 'users.avatar')
                                ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $committee->id)
                                ->paginate(300);
                              
        return view('app/vipuser/dashbord', compact('guideline','committee','committee_member'));
    }

    public function guideline()
    {
        View::share('routeGroup','vipuser_guideline');

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


        return view('app/vipuser/guideline', compact('guideline','committee','committee_member'));
    }
}
