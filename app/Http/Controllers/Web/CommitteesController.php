<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\User;
use App\Models\Committee_member;
use App\Models\Committee_files;


class CommitteesController extends Controller
{
    public function index()
    {
        

        $committees = Committee::where('deleted_at', null)->orderBy('position', 'ASC')->paginate(4); 

        return view('web/committees', compact('committees'));


    }

    public function index_inner($id)
    {
        

        $committees = Committee::find($id); 
        

        $members = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role', 'users.avatar')
        ->where('users.role', '=' , 3)
        ->whereIn('students.status', [3])
        ->where('students.committee_choice', '=' , $id)
        ->orderBy('students.id', 'desc')
        ->paginate(12);

        $files = Committee_files::where('committe_id', $id)->where('deleted_at', null)->get(); 
       
       
        return view('web/committees-inner', compact('committees','members','files'));


    }



}
