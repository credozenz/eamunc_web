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
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class ViennaController extends IndexController
{

  


    public function get_vienna(Request $request)
    {
        $loguser = auth()->user();

        if($loguser->role != 4){
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id',$user->committee_choice)->first();

        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }


        $vienna = Vienna_formula::where('committe_id',$committee->id)->first();
      
        if (!$vienna) {

            $response['status']  = true;
            $response['data'] = [];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $vienna;
            return $this->sendResponse($response);
                
        }
    }


    public function add_vienna(Request $request)
    {

        $validator = Validator::make($request->all(), ['vienna' => 'required']);

            if ($validator->fails()) {

                    $response['status']  = false;
                    $response['message'] = 'Validation Error: ' . $validator->errors();
                    return $this->sendResponse($response);
                
            }

            $loguser = auth()->user();
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
             
            $committee = Committee::where('id',$user->committee_choice)->first();
    
            $vienna = Vienna_formula::where('committe_id',$committee->id)->first();
    
                if($vienna){
    
                    $vienna = Vienna_formula::where('id', $vienna->id)->first(); 
                    $vienna->content = $request->vienna;
                    $vienna->committe_id = $committee->id;
                    $vienna->save();
    
                }else{
    
                    $vienna = new Vienna_formula;
                    $vienna->content = $request->vienna;
                    $vienna->committe_id = $committee->id;
                    $vienna->save();
                    
                }
                
           
         
         if($vienna->id){
            $success['message'] = "Vienna added successfully";
            $success['status']  = true;
            return $this->sendResponse($success);
          }else{
            $response['status']  = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
          }

       

     


    }


 










}
