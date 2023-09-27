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


class LiabilityWaiverController extends IndexController
{


    public function get_liability_waiverform(Request $request)
    {

       
        $form = SiteIndexes::where('deleted_at', null)->where('type', 'liability_waiver')->orderBy('id', 'DESC')->first(); 
      
        if (!$form) {

            $response['status']  = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $form;
            return $this->sendResponse($response);
                
        }
    }



    public function add_liability_waiverform(Request $request)
    {

        $member =  auth()->user();

        $validator = Validator::make($request->all(), [
            'form' => ['required','mimes:pdf,doc', 'max:2055'],
        ]);

        if ($validator->fails()) {

                $response['status']  = false;
                $response['message'] = 'Validation Error: ' . $validator->errors();
                return $this->sendResponse($response);
            
        }


       
        $form = Students::where('user_id',$member->id)->first();

        if ($request->hasFile('form')) {
            
            $doc = $request->file('form');
            $origin_name = $doc ->getClientOriginalName();
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get();
           
            Storage::disk('public')->put('liability_submitform/'.$docfileName,$file,'public');
           
          
            $form->liability_form = 'liability_submitform/'.$docfileName; 
            $form->save();

            if($form->wasChanged('liability_form')){
                $success['message'] = "Liability form Submitted successfully!";
                $success['status']  = true;
                return $this->sendResponse($success);
              }else{
                $response['status']  = false;
                $response['message'] = "Something went wrong!!";
                return $this->sendResponse($response);
              }
          
         
        

        }else{
                $response['status']  = false;
                $response['message'] = "Something went wrong!!";
                return $this->sendResponse($response);
        }
       
    }



    public function show_liability_waiverform(Request $request)
    {

        $member =  auth()->user();

        $form = Students::where('user_id',$member->id)->first();

        if (!$form->liability_form) {

            $response['status']  = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $form->liability_form;
            return $this->sendResponse($response);
                
        }
          
         
        

       
       
    }
  
    
    public function delete_liability_waiverform(Request $request)
    {

        $form = SiteIndexes::find($request->form_id);

        if (!$form) {
            $response['status'] = false;
            $response['message'] = "Site Index not found.";
            return $this->sendResponse($response);
        }
        
        $mytime = Carbon::now();
        $timestamp = $mytime->toDateTimeString();
        $form->deleted_at = $timestamp;
        $form->save();
        
        if ($form->wasChanged('deleted_at')) {
            $success['message'] = "Liability Form Deleted Successfully!";
            $success['status'] = true;
            return $this->sendResponse($success);
        } else {
            $response['status'] = false;
            $response['message'] = "Something went wrong!";
            return $this->sendResponse($response);
        }
      
    }
}
