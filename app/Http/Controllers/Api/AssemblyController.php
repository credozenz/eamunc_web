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

class AssemblyController extends IndexController
{

  


    public function get_all_resolutions(Request $request)
    {

        $resolutions = Resolution::where('resolution.deleted_at', null)
                        ->join('committees', 'resolution.committe_id', '=', 'committees.id')
                        ->select('resolution.*','committees.name as committee_name','committees.title as committee_title')
                        ->where('committees.deleted_at', null)
                        ->where('resolution.deleted_at', null)
                        ->get();   

    
        if (!$resolutions) {

            $response['status']  = false;
            $response['message'] = "Please wait, This session has not started !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $resolutions;
            return $this->sendResponse($response);
                
        }
    }


    
    public function get_committe_resolution(Request $request)
    {

        $validator = Validator::make($request->all(), ['resolution_id' => 'required']);

        if ($validator->fails()) {

                $response['status']  = false;
                $response['message'] = 'Validation Error: ' . $validator->errors();
                return $this->sendResponse($response);
            
        }

        $resolutions = Resolution::where('resolution.deleted_at', null)
                        ->join('committees', 'resolution.committe_id', '=', 'committees.id')
                        ->select('resolution.*','committees.name as committee_name','committees.title as committee_title')
                        ->where('resolution.id', '=', $request->resolution_id)
                        ->where('committees.deleted_at', null)
                        ->where('resolution.deleted_at', null)
                        ->get();   

    
        if (!$resolutions) {

            $response['status']  = false;
            $response['message'] = "Please wait, This session has not started !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $resolutions;
            return $this->sendResponse($response);
                
        }
    }








}
