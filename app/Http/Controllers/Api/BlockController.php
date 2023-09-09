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
use App\Models\Bloc_chats;
use App\Models\Images;
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;
class BlockController extends IndexController
{

  
    public function get_blocks(Request $request)
    {
        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
        $committee = Committee::where('id',$user->committee_choice)->first();

        $committee_bloc = Blocs::where('committe_id',$user->committee_choice)->where('deleted_at', null)->get();
      
        if (!$committee_bloc) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
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






    public function get_block_chat(Request $request)
    {
       
        $blocs_chats = DB::table('bloc_chats as b')
                            ->join('users as u', 'b.user_id', '=', 'u.id')
                            ->select('b.*','u.name as user_name','u.avatar as avatar')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->where('b.bloc_id', '=',$request->block_id)
                            ->orderBy('b.id', 'ASC')
                            ->get();

                          
     
        if (!$blocs_chats) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = $blocs_chats;
            return $this->sendResponse($response);
                
        }
    }



    public function add_block_chat(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "message"         => 'required',
        ]);

        if ($validator->fails()) {

                $response['status']  = false;
                $response['message'] = 'Validation Error: ' . $validator->errors();
                return $this->sendResponse($response);
            
        }

      

        $loguser = auth()->user();
        $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
        $committee = Committee::where([['id', $student->committee_choice]])->first();
       
        $user_id      = $student->user_id;
        $committe_id  = $committee->id;
        $bloc_id      = $request->block_id;


        $message = $request->message;
        $type = 'text';



        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . str_random(5) . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
          
            if (in_array($extension, ['svg', 'png', 'jpg', 'jpeg', 'gif'])) {
                $type = 'image';

                if ($extension == 'svg') {
                    $img = $file->get();
                } else {
                    $img = Image::make($file->getRealPath());
                    $img->resize(1296, 845, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream('png', 100);
                }


            } else if (in_array($extension, ['doc', 'docx', 'pdf', 'xls', 'xlsx'])) {
                $type = 'file';
                $img = $file->get();
            } else {
                Session::flash('error', 'Handle unsupported file formats!!');
                return  redirect()->back();
            }


               
                
                Storage::disk('public')->put('chat/' . $fileName, $img, 'public');
                $message = 'chat/' . $fileName;
               
            
        }



        $chat = new Bloc_chats;
        $chat->bloc_id = $bloc_id;
        $chat->user_id = $user_id;
        $chat->committe_id = $committe_id;
        $chat->message = $message;
        $chat->type = $type;
        $chat->save();


        if (!$chat->id) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['message'] = "Message Send !";
            return $this->sendResponse($response);
                
        }
            
       
    
    }



    public function delete_block_chat(Request $request)
    {

        $chat = Bloc_chats::where('id', $request->message_id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $chat->deleted_at = $timestamp;
        $chat->save();               
                    

        if (!$chat) {

            $response['status']  = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data']   = "Chat successfully deleted";
            return $this->sendResponse($response);
                
        }
    }






}
