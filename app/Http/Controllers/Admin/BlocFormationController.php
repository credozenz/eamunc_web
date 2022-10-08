<?php

namespace App\Http\Controllers\Admin;

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
class BlocFormationController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','bloc_formation');

    }

    public function index(Request $request,$committee_id)
    {
       
        $committee = Committee::where('id',$committee_id)->first();

        $query = Blocs::where('committe_id',$committee_id)
                       ->where('deleted_at', null);
                       if($request->q){
                        $query->where('name','LIKE', $request->q);
                        }
                        $data=$query->orderBy('id', 'DESC')
                          ->paginate(10);

      
        return view('admin/blocFormation/index', compact('committee','data','request'));
    }


    public function create($committe_id)
    {
        
        $committee = Committee::where('id',$committe_id)->first();

        
        $committee_member = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->select('u.*')
                                ->where('s.status', '=', 3)
                                ->where('u.role', '=', 2)
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



        return view('admin/blocFormation/create', compact('committee_member','committee'));
    }




    public function store(Request $request)
    {

    
        $validatedData = $request->validate([
            "user_id"    => "required|array",
            "user_id.*"  => "required",
            'name'    => 'required|max:255',
            'committee_id'  => 'required|max:255',
        ],[
            
            'user_id.required' => 'The User field is required',
            'name.required' => 'The Bloc Name field is required',
            'committee_id.required' => 'The Committee field is required',
           
        ]);


       
       
        $user_id  = $request->input('user_id');
       
        $name = $request->input('name');
        $committee_id = $request->input('committee_id');
    
        $bloc = new blocs;
        $bloc->name = $name;
        $bloc->committe_id = $committee_id;
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
                return redirect('/admin/blocformation_show/'.$committee_id);
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
    



    }


    public function show(Request $request,$id)
    {
       
        $bloc = Blocs::where('id',$id)->first();
        $committee = Committee::where('id',$bloc->id)->first();
        $blocs_members = DB::table('users as u')
                            ->join('bloc_members as b', 'u.id', '=', 'b.user_id')
                            ->select('u.*')
                            ->where('b.bloc_id', '=' , $bloc->id)
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->get();
                           
      

        return view('admin/blocFormation/show', compact('bloc','blocs_members','committee'));
    }


    public function edit($bloc_id)
    {
        $bloc = Blocs::where('id',$bloc_id)->first();
        $committee = Committee::where('id',$bloc->committe_id)->first();
        $bloc_members = DB::table('bloc_members as m')
                            ->join('users as u', 'm.user_id', '=', 'u.id')
                            ->select('u.*')
                            ->where('m.bloc_id', '=' , $bloc_id)
                            ->where('m.deleted_at', null)
                            ->get();


        $committee_member = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->select('u.*')
                                ->where('s.status', '=', 3)
                                ->where('u.role', '=', 2)
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



        return view('admin/blocFormation/edit', compact('bloc','bloc_members','committee_member','committee'));
    }





    public function update(Request $request, $bloc_id)
    {

    
        $validatedData = $request->validate([
            "user_id"    => "required|array",
            "user_id.*"  => "required",
            'name'    => 'required|max:255',
        ],[
            
            'user_id.required' => 'The User field is required',
            'name.required' => 'The Bloc Name field is required',
           
        ]);


        $bloc = Blocs::where('id',$bloc_id)->first();
        $committee = Committee::where('id',$bloc->committe_id)->first();
       
        $user_id  = $request->input('user_id');
       
        $name = $request->input('name');
      
    
        $bloc = Blocs::where('id', $bloc_id)->first();
        $bloc->name = $name;
        $bloc->committe_id = $committee->id;
        $bloc->save();

        if(count($user_id) > 0){

            $mytime = Carbon::now();
            $timestamp=$mytime->toDateTimeString();
            $blocmem = Bloc_members::where('bloc_id', $bloc_id)->update(['deleted_at'=>$timestamp]); 
    
         

        for($count = 0; $count < count($user_id); $count++)
        {


            $bloc_member = new Bloc_members;
            $bloc_member->user_id  = $user_id[$count];
            $bloc_member->bloc_id  = $bloc_id;
            $bloc_member->save();
        
            
        }

            
            if($bloc_member->id){
                Session::flash('success', 'Bloc successfully Created!');
                return redirect('/admin/blocformation_show/'.$bloc->committe_id);
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }

        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }


    }


    public function delete(Request $request,$id)
    {

        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();

        $bloc = Blocs::where('id', $id)->first(); 
        $bloc->deleted_at = $timestamp;
        $bloc->save();

        $member = Bloc_members::where('bloc_id', $id)
                              ->update(["deleted_at" => $timestamp]);


        echo json_encode(['status'=>true,'message'=>'Bloc Deleted Successfully !']);exit();
    }



}
