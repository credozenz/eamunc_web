<?php

namespace App\Http\Controllers\App\Delegate;

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
use App\Models\Speakers;
use Carbon\Carbon;
use View;
use Illuminate\Support\Facades\Auth;
class DelegateSpeakersController extends Controller
{

    public function __construct()
    {
        
        View::share('routeGroup','delegate_dashbord');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();
        
        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $committee_member =  User::where('users.deleted_at', null)
                                    ->join('students', 'users.id', '=', 'students.user_id')
                                    ->join('countries', 'students.country_choice', '=', 'countries.id')
                                    ->select('students.*','countries.name as country_name','countries.id as country_id')
                                    // ->where('users.role', '=', 2)
                                    ->where('students.status', '=', 3)
                                    ->where('students.committee_choice', '=' , $committee->id)
                                    ->get();

        $speakers =  User::where('users.deleted_at', null)
                                    ->join('speakers', 'users.id', '=', 'speakers.user_id')
                                    ->join('countries', 'speakers.country_id', '=', 'countries.id')
                                    ->select('speakers.*','countries.name as country_name','countries.id as country_id')
                                    // ->where('users.role', '=', 2)
                                    ->where('speakers.deleted_at', '=', null)
                                    ->where('speakers.committe_id', '=' , $committee->id)
                                    ->get();                            
                    
                                    $speakersCount = count($speakers);

        return view('app/delegate/speakers', compact('guideline','committee','committee_member','speakers','speakersCount'));
    }


    public function bureau_speaker_country(Request $request)
    {
       
        $speaker_country = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->join('countries', 'students.country_choice', '=', 'countries.id')
                                ->select('students.*','countries.name as country_name','countries.id as country_id')
                                // ->where('users.role', '=', 2)
                                 ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $request->committe_id)
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
            // ->where('users.role', '=', 2)
            ->where('students.status', '=', 3)
            ->where('students.country_choice', '=', $country_id[$count])
            ->where('students.committee_choice', '=' , $committe_id)
            ->first();


           
           
            $speaker = new Speakers;
            $speaker->country_id  = $country_id[$count];
            $speaker->committe_id = $committe_id;
            $speaker->user_id = $user->id;
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
