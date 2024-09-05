<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\Images;
use App\Models\User;
use App\Models\Committee_member;
use App\Models\Committee_files;
use App\Models\Countries;

class CommitteesController extends Controller
{
    public function index()
    {
        

        $committees = Committee::where('deleted_at', null)->orderBy('position', 'ASC')->paginate(4); 

        $press_corp = SiteIndexes::where('deleted_at', null)->where('type', 'press_corp')->first();

        if(isset($press_corp->id)){
            $press_corp_members = Images::where('type', 'press_corp')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(12);
        }else{
            $press_corp_members =[];
        }
        return view('web/committees', compact('committees','press_corp','press_corp_members'));


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
        // ->orderBy('students.id', 'desc')
        // ->orderByRaw("FIELD(students.position, 'President', 'Vice President', 'Rapporteur','Secretary General','Editor in Chief')")
        ->orderByRaw("CASE
        WHEN students.position IS NULL OR students.position = '' THEN 1
        ELSE 0
    END,
    FIELD(LOWER(students.position), 'president','president1','president 1','president2','president 2', 'vice president','vice president1','vice president 1','vice president2','vice president 2', 'rapporteur','rapporteur1','rapporteur 1','rapporteur2','rapporteur 2', 'secretary general','secretary', 'editor in chief')")
    ->paginate(12);

        $files = Committee_files::where('committe_id', $id)->where('deleted_at', null)->get(); 
       
       
        return view('web/committees-inner', compact('committees','members','files'));


    }


    public function presscorp_inner()
    {
        

        $press_corp = SiteIndexes::where('deleted_at', null)->where('type', 'press_corp')->first();

        if(isset($press_corp->id)){
            $press_corp_members = Images::where('type', 'press_corp')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(12);
        }else{
            $press_corp_members =[];
        }
        return view('web/presscorp-inner', compact('press_corp','press_corp_members'));


    }


    public function committee_country(Request $request)
    {
     $committeeChoice = $request->input('committee_choice');
    
     $countries = Countries::where('countries.deleted_at', null)
         ->whereNotIn('countries.id', function($query) use ($committeeChoice) {
         $query->select('students.country_choice')
             ->from('students')
             ->where('students.deleted_at', null)
             ->join('committees', 'students.committee_choice', '=', 'committees.id')
             ->where('committees.id', '=', $committeeChoice)
             ->whereIn('students.status', [1, 2, 3]);
     })   
     ->get();
     
     return response()->json($countries);
 
     }



}
