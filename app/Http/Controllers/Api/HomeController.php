<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Models\Committee;
use App\Models\Students;
use App\Models\User;
use App\Models\SiteIndexes;
use App\Models\Speakers;
use App\Models\Program_schedule;
use App\Models\Program_schedule_time;
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\Images;
use App\Models\Committee_files;
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;
class HomeController extends IndexController
{

  
    public function get_rules_Procedure(Request $request)
    {

        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        if (!$guideline) {

            $response['status']  = true;
            $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $guideline;
            return $this->sendResponse($response);
                
        }
    }

    public function get_speakers_list(Request $request)
    {

        $loguser = auth()->user();
        if($loguser->role != 4){
            $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $committee = Committee::where([['id', $student->committee_choice]])->first();
        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        

        $speakers =  User::where('users.deleted_at', null)
                                    ->join('speakers', 'users.id', '=', 'speakers.user_id')
                                    ->join('countries', 'speakers.country_id', '=', 'countries.id')
                                    ->select('speakers.*','countries.name as country_name','countries.id as country_id')
                                    ->where('users.role', '=', 2)
                                    ->where('speakers.deleted_at', '=', null)
                                    ->where('speakers.committe_id', '=' , $committee->id)
                                    ->get();                            
                    

        if (!$speakers) {

            $response['status']  = true;
            $response['data'] = [];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $speakers;
            return $this->sendResponse($response);
                
        }
    }

    public function speakers_country(Request $request)
    {
        $loguser = auth()->user();
        $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
        $committee = Committee::where([['id', $student->committee_choice]])->first();

      
        $speaker_country = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->join('countries as c', 's.country_choice', '=', 'c.id')
                                ->select('s.*','c.name as country_name','c.id as country_id')
                                ->where('s.status', '=', 3)
                                ->where('u.role', '=', 2)
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
                           
                    

        if (!$speaker_country) {

            $response['status']  = true;
            $response['data']    = [];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $speaker_country;
            return $this->sendResponse($response);
                
        }
    }


    public function add_speakers(Request $request)
    {


            // Validate the request data
            $validator = Validator::make($request->all(), [
                "country_id"    => "required",
            ]);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();
            $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $committee = Committee::where([['id', $student->committee_choice]])->first();

            $countryId   = $request->country_id;
            $committeeId = $committee->id;
      

      
            $user = User::where('users.deleted_at', null)
                        ->join('students', 'users.id', '=', 'students.user_id')
                        ->join('countries', 'students.country_choice', '=', 'countries.id')
                        ->select('students.*','countries.name as country_name')
                        ->where('users.role', '=', 2)
                        ->where('students.status', '=', 3)
                        ->where('students.country_choice', '=', $countryId)
                        ->where('students.committee_choice', '=' , $committeeId)
                        ->first();


                if (empty($user->user_id)) {
        
                    $response['status']  = false;
                    $response['message'] = "Unknown country user in this committee.";
                    return $this->sendResponse($response);
                        
                }
           
            $speaker = new Speakers;
            $speaker->country_id  = $countryId;
            $speaker->committe_id = $committeeId;
            $speaker->user_id = $user->user_id;
            $speaker->save();
        
            
            if (!empty($speaker->id)) {

                $success['message'] = "Speakers successfully added";
                $success['status'] = true;
                return $this->sendResponse($success);
    
             }else{
    
                $response['status'] = false;
                $response['message'] = "No speakers added. Check your input data.";
                return $this->sendResponse($response);
                    
            }

    }



    public function get_program_schedule(Request $request)
    {

            $loguser = auth()->user();
            

            if($loguser->role != 4){
                $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
                $committee = Committee::where([['id', $student->committee_choice]])->first();
            }else{
                $committee = Committee::where([['id', $request->committee_id]])->first();
            }


        $schedule = Program_schedule::where('deleted_at', null)->where('committe_id', $committee->id)->orderBy('id', 'ASC')->paginate(25);
  
        $program_schedule = $schedule->map(function($item, $key) {

        $time = Program_schedule_time::where('schedule_id', $item->id)->get();
                                return [
                                    'id' => $item->id,
                                    'date' => $item->date,
                                    'time' => $time,
                                ];
                            });                            
                    

        if (!$program_schedule) {

            $response['status']  = true;
            $response['data']    = [];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $program_schedule;
            return $this->sendResponse($response);
                
        }
    }


    public function delete_program_schedule(Request $request)
    {

        $schedule = Program_schedule::where('id', $request->schedule_id)->first(); 
        $mytime   = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $schedule->deleted_at = $timestamp;
        $schedule->save();               
                    

        if (!$schedule) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = "Program schedule successfully deleted";
            return $this->sendResponse($response);
                
        }
    }


    public function add_program_schedule(Request $request)
    {

            $validator = Validator::make($request->all(), [
                "date"         => 'required',
                "title"    => "required|array",
                "title.*"  => "required",
                "time_start"    => "required|array",
                "time_start.*"  => "required",
                "time_end"    => "required|array",
                "time_end.*"  => "required",
            ]);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

         
            $loguser = auth()->user();
            $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $committee = Committee::where([['id', $student->committee_choice]])->first();

     
        $schedule = new Program_schedule;
        $schedule->committe_id = $committee->id;
        $schedule->date  = date('Y-m-d',strtotime($request->date));
        $schedule->save();

        $title = $request->title;
        $start_time = $request->time_start;
        $end_time = $request->time_end;
       
        
        $insert_schedule=array();

        for($count = 0; $count < count($title); $count++)
        {
            if(!empty($title[$count])){
            $data = array(
                    'title' => $title[$count],
                    'time_start'  => $start_time[$count],
                    'time_end'    => $end_time[$count],
                    'schedule_id' => $schedule->id,
                  );
    
            $insert_schedule[] = $data; 
                }
         }
         
         Program_schedule_time::insert($insert_schedule);
    

            
            if (!empty($schedule->id)) {

                $success['message'] = "Schedule added successfully";
                $success['status']  = true;
                return $this->sendResponse($success);
    
             }else{
    
                $response['status']  = false;
                $response['message'] = "No Schedule added. Check your input data.";
                return $this->sendResponse($response);
                    
            }




    }




    public function get_blocks(Request $request)
    {
        $loguser = auth()->user();
       

        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();
        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }


        $committee_bloc = Blocs::where('committe_id',$committee->id)->where('deleted_at', null)->get();
      
        if (!$committee_bloc) {

            $response['status']  = true;
           $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $committee_bloc;
            return $this->sendResponse($response);
                
        }
    }



    public function add_blocks(Request $request)
    {

            $validator = Validator::make($request->all(), [
                                                            "member_id"    => "required|array",
                                                            "member_id.*"  => "required",
                                                            "name"         => 'required|max:255',
                                                          ]);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();
          
            $user_id  = $request->member_id;
           
            $name = $request->name;
          
        
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
    

            
            if (!empty($bloc_member->id)) {

                $success['message'] = "Block added successfully";
                $success['status']  = true;
                return $this->sendResponse($success);
    
             }else{
    
                $response['status']  = false;
                $response['message'] = "No Block added. Check your input data.";
                return $this->sendResponse($response);
                    
            }




    }



    public function delete_blocks(Request $request)
    {

        $block = blocs::where('id', $request->block_id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $block->deleted_at = $timestamp;
        $block->save();               
                    

        if (!$block) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = "Block successfully deleted";
            return $this->sendResponse($response);
                
        }
    }


    public function update_blocks(Request $request)
    {

            $validator = Validator::make($request->all(), [
                                                            "member_id"    => "required|array",
                                                            "member_id.*"  => "required",
                                                            "name"         => 'required|max:255',
                                                            "block_id"     => 'required',
                                                          ]);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

         
            $loguser = auth()->user();
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();
           
            $user_id  = $request->member_id;
            $block_id = $request->block_id;
            $name = $request->name;
          
        
            $bloc = Blocs::where('id', $block_id)->first();
            $bloc->name = $name;
            $bloc->committe_id = $committee->id;
            $bloc->save();
    
            if(count($user_id) > 0){

                $mytime = Carbon::now();
                $timestamp=$mytime->toDateTimeString();
                $blocmem = Bloc_members::where('bloc_id', $block_id)->update(['deleted_at'=>$timestamp]); 
        
             
    
                for($count = 0; $count < count($user_id); $count++)
                {
        
        
                    $bloc_member = new Bloc_members;
                    $bloc_member->user_id  = $user_id[$count];
                    $bloc_member->bloc_id  = $block_id;
                    $bloc_member->save();
                
                    
                }
        
                    
                if (!empty($bloc_member->id)) {

                    $success['message'] = "Block update successfully";
                    $success['status']  = true;
                    return $this->sendResponse($success);
        
                }else{
        
                    $response['status']  = false;
                    $response['message'] = "No Block added. Check your input data.";
                    return $this->sendResponse($response);
                        
                }
    
            }else{
        
                $response['status']  = false;
                $response['message'] = "Something went wrong!";
                return $this->sendResponse($response);
            }
    

    }












    public function get_live_stream(Request $request)
    {
        $loguser = auth()->user();
        

        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();
        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }


        $committee_lives = Images::where('connect_id', $committee->id)->where('type', 'app_committee_live')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(12);
       
      
        if (!$committee_lives) {

            $response['status']  = true;
           $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $committee_lives;
            return $this->sendResponse($response);
                
        }
    }



    public function add_live_stream(Request $request)
    {

            $validator = Validator::make($request->all(), ['live_url' =>'required|max:255',]);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();

            $youtubeurl = ApiHelper::getYoutubeIdFromUrl($request->live_url);
           
            $gallery = new Images;
            $gallery->type = 'app_committee_live';
            $gallery->connect_id = $committee->id;
            $gallery->video = $youtubeurl;
            $gallery->save();

            
            if (!empty($gallery->id)) {

                $success['message'] = "Live stream added successfully";
                $success['status']  = true;
                return $this->sendResponse($success);
    
             }else{
    
                $response['status']  = false;
                $response['message'] = "No Live stream added. Check your input data.";
                return $this->sendResponse($response);
                    
            }




    }



    public function delete_live_stream(Request $request)
    {

        $gallery = Images::where('id', $request->stream_id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $gallery->deleted_at = $timestamp;
        $gallery->save();         
                    

        if (!$gallery) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = "Live stream successfully deleted";
            return $this->sendResponse($response);
                
        }
    }








    public function get_program_resources(Request $request)
    {

        $loguser = auth()->user();
       
        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();

        }else{
            $committee = Committee::where('id', $request->committee_id)->first();
        }

        $program =[];
        $program['committee'] =$committee;

        $members = user::where('users.deleted_at', null)
                        ->join('students', 'users.id', '=', 'students.user_id')
                        ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                        ->select('students.*', 'schools.name as school_name', 'users.role', 'users.avatar')
                        ->where('users.role', '=' , 3)
                        ->whereIn('students.status', [3])
                        ->where('students.committee_choice', '=' , $committee->id)
                        ->orderBy('students.id', 'desc')
                        ->get();
                        
        $program['members'] =$members;
        $files = Committee_files::where('committe_id', $committee->id)->where('deleted_at', null)->get(); 
        $program['files'] =$files;
        if (!$program) {

            $response['status']  = true;
           $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $program;
            return $this->sendResponse($response);
                
        }
    }






    public function delete_speaker(Request $request)
    {
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $speak = Speakers::where('id', $request->speaker_id)->update(['deleted_at'=>$timestamp]);

        if (!$speak) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = "Speaker successfully deleted";
            return $this->sendResponse($response);
                
        }
    }






}
