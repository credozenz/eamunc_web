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
use App\Models\Speakers;
use Carbon\Carbon;
use View;
use Illuminate\Support\Facades\Auth;
class BureauSpeakersController extends Controller
{

    public function __construct()
    {
        
        View::share('routeGroup','bureau_dashbord');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $committee_member =  User::where('users.deleted_at', null)
                                    ->join('students', 'users.id', '=', 'students.user_id')
                                    ->join('countries', 'students.country_choice', '=', 'countries.id')
                                    ->select('students.*','countries.name as country_name','countries.id as country_id')
                                    ->where('users.role', '=', 2)
                                    ->where('students.status', '=', 3)
                                    ->where('students.committee_choice', '=' , $committee->id)
                                    ->get();


                                 

        $speakers =  User::where('users.deleted_at', null)
                                    ->join('speakers', 'users.id', '=', 'speakers.user_id')
                                    ->join('countries', 'speakers.country_id', '=', 'countries.id')
                                    ->select('speakers.*','countries.name as country_name','countries.id as country_id')
                                    ->where('users.role', '=', 2)
                                    ->where('speakers.deleted_at', '=', null)
                                    ->where('speakers.committe_id', '=' , $committee->id)
                                    ->get();                            
                    
                                   

                                    $speakersCount = count($speakers);


              

        return view('app/bureau/speakers', compact('committee','committee_member','speakers','speakersCount'));
    }


    public function bureau_speaker_country(Request $request)
    {

        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();

        $speaker_country = DB::table('users as u')
        ->join('students as s', 'u.id', '=', 's.user_id')
        ->join('countries as c', 's.country_choice', '=', 'c.id')
        ->select('s.*','c.name as country_name','c.id as country_id')
        ->where('s.status', '=', 3)
        ->where('u.deleted_at', null)
        ->where('s.committee_choice', '=' , $committee->id)
        ->whereNotExists(function($query)
                {
                    $query->select(DB::raw(1))
                        ->from('speakers as sp')
                        ->whereRaw('u.id = sp.user_id')
                        ->where('sp.deleted_at', null);
                })
        ->get();
       
     

       echo json_encode(['status'=>true,'data'=>$speaker_country]);exit();
    }

    public function store(Request $request)
    {
       
        $validatedData = $request->validate([
            "country_id"    => "required|array",
            "country_id.*"  => "required",
            'committe_id'    => 'required|max:255',
        ],[
            
            'country_id.required' => 'The Country field is required',
            'committe_id.required' => 'The committe field is required',
           
        ]);
      
       

        $country_id  = $request->input('country_id');
       
        $committe_id = $request->input('committe_id');
      
    
        if(count($country_id) > 0){

            $mytime = Carbon::now();
            $timestamp=$mytime->toDateTimeString();
            $speak = Speakers::where('committe_id', $committe_id)->update(['deleted_at'=>$timestamp]); 
    
         }

        for($count = 0; $count < count($country_id); $count++)
        {


            $user = User::where('users.deleted_at', null)
            ->join('students', 'users.id', '=', 'students.user_id')
            ->join('countries', 'students.country_choice', '=', 'countries.id')
            ->select('students.*','countries.name as country_name')
            ->where('users.role', '=', 2)
            ->where('students.status', '=', 3)
            ->where('students.country_choice', '=', $country_id[$count])
            ->where('students.committee_choice', '=' , $committe_id)
            ->first();


           
           
            $speaker = new Speakers;
            $speaker->country_id  = $country_id[$count];
            $speaker->committe_id = $committe_id;
            $speaker->user_id = $user->user_id;
            $speaker->save();
        
            
        }

            
        
       
            if($speaker->id){
                Session::flash('success', 'Speaker successfully Added!');
                return redirect('/app/bureau_speaker');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
    

   
    
    }




    public function destroy(Request $request,$id)
    {
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $speak = Speakers::where('id', $id)->update(['deleted_at'=>$timestamp]);

        echo json_encode(['status'=>true,'message'=>'Speaker Deleted Successfully !']);exit();
    }





}
