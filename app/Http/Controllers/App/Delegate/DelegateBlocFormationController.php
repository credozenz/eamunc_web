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
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\User;
use Carbon\Carbon;
use View;
class DelegateBlocFormationController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','delegate_bloc_formation');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();

        $committee_bloc = Blocs::where('committe_id',$member->committee_choice)->get();

        $committee_member = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->select('u.*')
                                ->where('s.status', '=', 3)
                                ->where('u.deleted_at', null)
                                ->where('s.committee_choice', '=' , $committee->id)
                                ->whereNotExists(function($query)
                                        {
                                          $query->select(DB::raw(1))
                                                ->from('bloc_members as bm')
                                                ->whereRaw('u.id = bm.user_id')
                                                ->where('bm.deleted_at', null);
                                        })
                                ->get();



        return view('app/delegate/bloc_formation', compact('guideline','committee','committee_member','committee_bloc'));
    }



    public function store(Request $request)
    {

    
        $validatedData = $request->validate([
            "user_id"    => "required|array",
            "user_id.*"  => "required",
            'name'    => 'required|max:255',
        ],[
            
            'user_id.required' => 'The User field is required',
            'name.required' => 'The Bloc Name field is required',
           
        ]);


        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $user_id  = $request->input('user_id');
       
        $name = $request->input('name');
      
    
        $bloc = new blocs;
        $bloc->name = $name;
        $bloc->committe_id = $committee->id;
        $bloc->save();

        for($count = 0; $count < count($user_id); $count++)
        {


            $bloc_member = new Bloc_members;
            $bloc_member->user_id  = $user_id[$count];
            $bloc_member->bloc_id = $bloc->id;
            $bloc_member->save();
        
            
        }

            
            if($bloc_member->id){
                Session::flash('success', 'Bloc successfully Created!');
                return redirect('/app/delegate_bloc_formation');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
    



    }


    public function show(Request $request,$id)
    {
       
        $blocs = Blocs::where('id',$id)->first();

        $blocs_members = DB::table('users as u')
                            ->join('bloc_members as b', 'u.id', '=', 'b.user_id')
                            ->select('u.*')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->get();
       
        $committee_member = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->select('u.*')
                                ->where('s.status', '=', 3)
                                ->where('u.deleted_at', null)
                                ->where('s.committee_choice', '=' , $blocs->committe_id)
                                ->whereNotExists(function($query)
                                        {
                                            $query->select(DB::raw(1))
                                                ->from('bloc_members as bm')
                                                ->whereRaw('u.id = bm.user_id')
                                                ->where('bm.deleted_at', null);
                                        })
                                ->get();

        return view('app/delegate/bloc_show', compact('blocs','blocs_members','committee_member'));
    }


    public function update(Request $request, $id)
    {

    
        $validatedData = $request->validate([
            "user_id"    => "required|array",
            "user_id.*"  => "required",
            'name'    => 'required|max:255',
        ],[
            
            'user_id.required' => 'The User field is required',
            'name.required' => 'The Bloc Name field is required',
           
        ]);


        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $user_id  = $request->input('user_id');
       
        $name = $request->input('name');
      
    
        $bloc = Blocs::where('id', $id)->first();
        $bloc->name = $name;
        $bloc->committe_id = $committee->id;
        $bloc->save();

        if(count($user_id) > 0){

            $mytime = Carbon::now();
            $timestamp=$mytime->toDateTimeString();
            $blocmem = Bloc_members::where('bloc_id', $id)->update(['deleted_at'=>$timestamp]); 
    
         

        for($count = 0; $count < count($user_id); $count++)
        {


            $bloc_member = new Bloc_members;
            $bloc_member->user_id  = $user_id[$count];
            $bloc_member->bloc_id  = $id;
            $bloc_member->save();
        
            
        }

            
            if($bloc_member->id){
                Session::flash('success', 'Bloc successfully Created!');
                return redirect('/app/delegate_bloc_formation');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }

        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }


    }


}
