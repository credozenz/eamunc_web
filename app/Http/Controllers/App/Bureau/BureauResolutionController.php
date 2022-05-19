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
use App\Models\User;
use App\Models\Resolution;
use View;
class BureauResolutionController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','bureau_resolution');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $committee_member = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->join('schools', 'students.school_id', '=', 'schools.id')
                                ->select('students.*', 'schools.name as school_name', 'users.role')
                                ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $committee->id)
                                ->paginate(300);


        return view('app/bureau/resolution', compact('committee','committee_member'));
    }


    public function show()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $resolution = Resolution::where('committe_id',$committee->id)->first();

        return view('app/bureau/resolution_editor', compact('committee','resolution'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'resolution'    => 'required',
        ],[
            'resolution.required' => 'The Resolution field is required', 
        ]);


        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();

        $resolution = Resolution::where('committe_id',$committee->id)->first();

            if($resolution){

                $resolution = Resolution::where('id', $resolution->id)->first(); 
                $resolution->content = $request->resolution;
                $resolution->committe_id = $committee->id;
                $resolution->save();

                    }else{

                $resolution = new Resolution;
                $resolution->content = $request->resolution;
                $resolution->committe_id = $committee->id;
                $resolution->save();
                
            }
            
        

            
        if($resolution->id){
            Session::flash('success', 'Resolution Submitted !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }




}
