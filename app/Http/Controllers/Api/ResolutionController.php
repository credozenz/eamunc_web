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
use App\Models\Paper_submission;
use App\Models\Vienna_formula;
use App\Models\Line_by_line;
use App\Models\Resolution;
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class ResolutionController extends IndexController
{

  


    public function get_resolution(Request $request)
    {
        $loguser = auth()->user();

        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $committee = Committee::where('id',$user->committee_choice)->first();

        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }


        $resolution = Resolution::where('committe_id',$committee->id)->first();
      
        if (!$resolution) {

            $response['status']  = true;
            $response['data'] = [];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $resolution;
            return $this->sendResponse($response);
                
        }
    }


    public function add_resolution(Request $request)
    {

        $validator = Validator::make($request->all(), ['resolution' => 'required']);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            
           
            $committee = Committee::where('id',$user->committee_choice)->first();
    
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
            $success['message'] = "Resolution added successfully";
            $success['status']  = true;
            return $this->sendResponse($success);
          }else{
            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
          }

       

     


    }


 

    public function accept_resolution(Request $request)
    {

        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
    
        $committee = Committee::where('id',$user->committee_choice)->first();

        $resolution = Resolution::where('committe_id',$committee->id)->first();

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        $newDelegateId = $user->id;
        
        if(!empty($resolution->accepted_delegates)){
            if (!in_array($newDelegateId, $acceptedDelegatesArray)) {
                $acceptedDelegatesArray[] = $newDelegateId;           
            }

            $acceptedDelegates = implode(',', $acceptedDelegatesArray);
        }else{
            $acceptedDelegates = $newDelegateId;
        }
        

        
        
        $resolution = Resolution::where('id', $resolution->id)->first(); 
        $resolution->accepted_delegates = $acceptedDelegates;
        $resolution->save();
              
        

        if($resolution->id){
            $success['message'] = "Resolution Accepted";
            $success['status']  = true;
            return $this->sendResponse($success);
          }else{
            $response['status']  = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
          } 
       
    

    }


    public function accept_resolution_list(Request $request)
    {

        $loguser = auth()->user();

        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();

        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }


        

        $resolution = Resolution::where('committe_id',$committee->id)->first();

        if(isset($resolution->accepted_delegates) && !empty($resolution->accepted_delegates)){

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        $newDelegateId = $user->id;
        
        
        $acceptedDelegates=[];
        foreach ($acceptedDelegatesArray as $Delegate){ 
            $acceptedDelegates[] = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                                ->select('users.*', 'schools.name as school_name','students.position','users.role', 'users.avatar')
                                ->where('students.user_id', '=', $Delegate)
                                ->get();
        }
     
              
        

        if($acceptedDelegates){

            $response['status'] = true;
            $response['data']   = $acceptedDelegates;
            return $this->sendResponse($response);
          }else{
            $response['status']  = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
          } 

        }else{
            $response['status'] = true;
            $response['data']   = [];
            return $this->sendResponse($response);
        }
       
    

    }









}
