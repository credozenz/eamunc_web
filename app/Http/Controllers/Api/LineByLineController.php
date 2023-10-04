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
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class LineByLineController extends IndexController
{

  


    public function get_line_by_line(Request $request)
    {

        $loguser = auth()->user();

        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $committee = Committee::where('id',$user->committee_choice)->first();

        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }
       

        $line = Line_by_line::where('committe_id',$committee->id)->first();
     
        if (!$line) {

            $response['status']  = true;
            $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $line;
            return $this->sendResponse($response);
                
        }
    }


    public function add_line_by_line(Request $request)
    {

        $validator = Validator::make($request->all(), ['line' => 'required']);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();

            if($loguser->role != 4){
                $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
                $committee = Committee::where('id',$user->committee_choice)->first();
    
            }else{
                $committee = Committee::where([['id', $request->committee_id]])->first();
            }

            
    
            $line = Line_by_line::where('committe_id',$committee->id)->first();
    
                if($line){
    
                    $line = Line_by_line::where('id', $line->id)->first(); 
                    $line->content = $request->line;
                    $line->committe_id = $committee->id;
                    $line->save();
    
                }else{
    
                    $line = new Line_by_line;
                    $line->content = $request->line;
                    $line->committe_id = $committee->id;
                    $line->save();
                    
                }
                
           
         
         if($line->id){
            $success['message'] = "line by line added successfully";
            $success['status']  = true;
            return $this->sendResponse($success);
          }else{
            $response['status']  = false;
            $response['message'] = "No line by line added. Check your input data.";
            return $this->sendResponse($response);
          }

       

     


    }


 










}
