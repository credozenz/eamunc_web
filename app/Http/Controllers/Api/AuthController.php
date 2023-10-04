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
use App\Models\Countries;
use View;
use Illuminate\Support\Facades\Validator;
use App\Helpers\ApiHelper;
use Str;
use Image;
use Storage;
use League\Flysystem\File;
class AuthController extends IndexController
{

  
    public function login(Request $request)
    {
        
        $validator = Validator::make($request->all(), ['username' => 'required','password' => 'required','committee' => 'required',]);
    
        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $committee = Committee::where([['id', $request->committee], ['deleted_at', '=', '']])->first();
           
        $user = User::where('email', $request->username)->where('deleted_at', null)->whereIn('role', [2,3,4])->first();

        if(empty($user->id)){
            $response['status']  = false;
            $response['message'] = "Unable to login - Unknown User";
            return $this->sendResponse($response);

        }else{

            if($user->role == 2 || $user->role == 3){

                $student   = Students::where('user_id', $user->id)->first(); 
                $committee_id = $student->committee_choice;

                if($request->committee == $committee_id){

                    $committee = $committee_id;

                }else{

                    $response['status']  = false;
                    $response['message'] = "You are not a member of this committee. Kindly choose the right committee or contact a beaureau member for assistance.";
                    return $this->sendResponse($response);
                   
                }

          
            }elseif($user->role == 4){

                $committee = $request->committee_id;

            }   


            if(Hash::check($request->password,$user->password)){

               
    
       
            // Generate and attach a new access token
            $token = $user->createToken('token');
            $user->token = $token->plainTextToken;
            
            $success['user'] = $user;
            $success['message'] = "Login Success";
            $success['status'] = true;
            return $this->sendResponse($success);

            }else{

            $response['status'] = false;
            $response['message'] = "Unable to login - Password incorrect";
            return $this->sendResponse($response);
                
            }

        }

    }


    public function logout(Request $request)
    {
    $user = auth()->user();

    $user->tokens->each(function ($token, $key) {
        $token->delete();
    });

    // Respond with a success message
    $response['message'] = "Successfully logged out.";
    $response['status'] = true;
    return $this->sendResponse($response);
    }


    public function get_profile(Request $request)
    {
        
        $loguser = auth()->user();
        if($loguser->role != 4){
            $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $country   = Countries::where('id', $student->country_choice)->where('deleted_at', null)->first(); 
        
            $loguser['phone_code'] = $student->phone_code ?? '';
            $loguser['whatsapp_no'] = $student->whatsapp_no ?? '';
            $loguser['country_choice'] = $student->country_choice ?? '';
            $loguser['class'] = $student->class ?? '';
            $loguser['country_name'] = $country->name ?? '';
        }
        if (!$loguser) {
            $response['status']  = true;
            $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data'] = $loguser;
            return $this->sendResponse($response);
                
        }
    }

    public function get_committee(Request $request)
    {

        $loguser = auth()->user();
        if($loguser->role != 4){
            $student   = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first(); 
            $committee = Committee::where([['id', $student->committee_choice]])->first();
        }else{
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        if (!$committee) {
            $response['status']  = true;
           $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data'] = $committee;
            return $this->sendResponse($response);
                
        }
    }

    public function get_allcommittee(Request $request)
    {

        $committees = Committee::where([['deleted_at', null]])->paginate(300);

        if (!$committees) {
            $response['status']  = true;
           $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data'] = $committees;
            return $this->sendResponse($response);
                
        }
    }

    public function get_committee_member(Request $request)
    {

            $loguser = auth()->user();
            if($loguser->role != 4){
                $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
                $committee = Committee::where('id',$user->committee_choice)->first();
            }else{
                $committee = Committee::where([['id', $request->committee_id]])->first();
            }

            $committee_member = User::where('users.deleted_at', null)
                                    ->join('students', 'users.id', '=', 'students.user_id')
                                    ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                                    ->select('users.*', 'schools.name as school_name', 'students.position', 'users.role', 'users.avatar')
                                    ->where('students.status', '=', 3)
                                    ->where('students.committee_choice', '=' , $committee->id)
                                    ->get();

        if (!$committee_member) {
            $response['status']  = true;
           $response['data'] = (object)[];
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data'] = $committee_member;
            return $this->sendResponse($response);
                
        }
    }




    public function update_password(Request $request)
{
    $validator = Validator::make($request->all(), [
        'password' => 'required|string|min:8',
        'password_confirm' => 'required|same:password',
    ], [
        'password.min' => 'The password must be at least 8 characters long.',
        'password.string' => 'The password must be a string.',
        'password.required' => 'The password field is required.',
        'password_confirm.required' => 'The password confirmation field is required.',
        'password_confirm.same' => 'The password and password confirmation must match.',
    ]);

    if ($validator->fails()) {
        return $this->sendError($validator->errors());
    }

    // Retrieve the user's profile
    $loguser = auth()->user();

    if (!$loguser) {
        $response['status'] = false;
        $response['message'] = "User not found";
        return $this->sendResponse($response);
    }

    // Update the user's password
    $loguser->password = Hash::make($request->password);
    $loguser->save();

    if ($loguser->id) {
        $response['status'] = true;
        $response['message'] = "Password updated successfully!";
        return $this->sendResponse($response);
    } else {
        $response['status'] = false;
        $response['message'] = "Something went wrong!";
        return $this->sendResponse($response);
    }
}



    public function update_avatar(Request $request)
{
    // Validate the request data
    $validator = Validator::make($request->all(), [
        'avatar' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // Reduce max size to 2MB (2048 KB)
    ], [
        'avatar.max' => 'Image must be smaller than 2 MB',
        'avatar.mimes' => 'Input accepts only jpeg, png, jpg, gif, svg images',
    ]);

    if ($validator->fails()) {
        return $this->sendError($validator->errors());
    }

    // Retrieve the user's profile
    $loguser = auth()->user();

    if (!$loguser) {
        $response['status'] = false;
        $response['message'] = "User not found";
        return $this->sendResponse($response);
    }

    if ($request->hasFile('avatar')) {
        // Handle avatar upload
        $image = $request->file('avatar');
        $extension = $image->getClientOriginalExtension();
        
        if ($extension === 'svg') {
            // For SVG images, no need for resizing
            $img = $image->get();
        } else {
            // For non-SVG images, resize and convert to PNG
            $width = 600;
            $height = 600;
            $img = Image::make($image->getRealPath());
            
            if ($img->height() > $img->width()) {
                $width = null;
            } else {
                $height = null;
            }
            
            $img->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
            
            $img->encode('png'); // Convert to PNG format
        }

        // Store the image in the storage disk (public storage)
        $fileName = time() . '_' . str_random(5) . '_' . rand(1111, 9999) . '.png'; // Always store as PNG
        Storage::disk('public')->put('user_image/' . $fileName, $img, 'public');

        // Update the user's avatar path in the database
        $loguser->avatar = 'user_image/' . $fileName;
        $loguser->save();

        $response['status'] = true;
        $response['message'] = "Avatar updated successfully!";
        return $this->sendResponse($response);
    }

    // If no avatar file was provided
    $response['status'] = false;
    $response['message'] = "Something went wrong !";
    return $this->sendResponse($response);
}




}
