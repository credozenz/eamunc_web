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
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;
class PaperController extends IndexController
{

  


    public function get_papers(Request $request)
    {

        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 

        $committee = Committee::where('id',$user->committee_choice)->first();

        $papers = Paper_submission::where('committe_id',$user->committee_choice)->get();

        $papers = DB::table('users as u')
                    ->join('paper_submissions as b', 'u.id', '=', 'b.user_id')
                    ->select('u.*','b.paper','b.id as paper_id')
                    ->where('u.deleted_at', null)
                    ->where('b.deleted_at', null)
                    ->where('b.committe_id', '=', $committee->id)
                    ->get();
      
        if (!$papers) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $papers;
            return $this->sendResponse($response);
                
        }
    }


    public function add_paper(Request $request)
    {

        $validator = Validator::make($request->all(), ['paper' => ['mimes:pdf,doc,docx', 'max:255']]);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
    

        if ($request->paper) {
            $image      =  $request->paper;
            
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            $img = $image->get();
           
            Storage::disk('public')->put('paper/'.$fileName,$img,'public');

            $paper = new Paper_submission;
            $paper->committe_id = $user->committee_choice;
            $paper->user_id     = $user->user_id;
            $paper->paper       = 'paper/'.$fileName; 
            $paper->paper_name  = $image->getClientOriginalName(); 
            $paper->save();
           
         
           if($paper->id){
            $success['message'] = "Paper added successfully";
            $success['status']  = true;
            return $this->sendResponse($success);
          }else{
            $response['status']  = false;
            $response['message'] = "No Paper added. Check your input data.";
            return $this->sendResponse($response);
          }

        }else{
            $response['status']  = false;
            $response['message'] = "Something went wrong!";
            return $this->sendResponse($response);
           
          }

     


    }


    public function view_paper(Request $request)
    {

        $loguser = auth()->user();

        $paper = Paper_submission::where('deleted_at', null)->where('user_id',$loguser->id)->first();            
                    

        if (!$paper) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $paper;
            return $this->sendResponse($response);
                
        }
    }


    public function delete_paper(Request $request)
    {

        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $paper = Paper_submission::where('id', $request->paper_id)->update(['deleted_at'=>$timestamp]); 
                    

        if (!$paper) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = "Paper successfully deleted";
            return $this->sendResponse($response);
                
        }
    }










}