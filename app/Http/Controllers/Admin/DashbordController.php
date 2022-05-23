<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
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

    public function getDashbord()
    {
        $Isg_count = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '!=' , 1)->where('users.type', '=' , 1)->orderBy('users.id', 'DESC')->count();

        $scoolDelecount = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '!=' , 1)->where('users.type', '=' , 2)->count();

       
       
        $cmtecount = Committee::where('deleted_at', null)->count(); 
        $schoolcount = School::where('deleted_at', null)->count(); 

        $delegate = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '!=' , 1)->where('users.type', '=' , 1)->orderBy('users.id', 'DESC')->paginate(10); 

        $school = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '!=' , 1)->where('users.type', '=' , 2)->orderBy('users.id', 'DESC')
        ->paginate(10);

        return view('admin/dashbord', compact('delegate','Isg_count','scoolDelecount','cmtecount','schoolcount','school'));
    }
}
