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
        $user = $request->user();
        $isUser = $user->tokens()->revoke();

        if ($isUser) {
            $success['message'] = "Successfully logged out.";
            $success['status'] = true;
            return $this->sendResponse($success);
        } else {
            $erroe['message'] = "Something went wrong.";
            $erroe['status'] = false;
            return $this->sendResponse($erroe);
        }
    }


    public function get_profile(Request $request)
    {

        $user = User::where('id', $request->user_id)->where('deleted_at', null)->first();

        if (!$user) {
            $response['status'] = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data'] = $user;
            return $this->sendResponse($response);
                
        }
    }

    public function get_committee(Request $request)
    {

        $user = User::where('id', $request->user_id)->where('deleted_at', null)->first();
        $student   = Students::where('user_id', $user->id)->where('deleted_at', null)->first(); 
        $committee = Committee::where([['id', $student->committee_choice]])->first();

        if (!$committee) {
            $response['status'] = false;
            $response['message'] = "Something went wrong !";
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
            $response['status'] = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);
     
        }else{

            $response['status'] = true;
            $response['data'] = $committees;
            return $this->sendResponse($response);
                
        }
    }

    public function get_committee_member(Request $request)
    {

        $committee_member = User::where('users.deleted_at', null)
                                ->join('students', 'users.id', '=', 'students.user_id')
                                ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
                                ->select('users.*', 'schools.name as school_name', 'users.role', 'users.avatar')
                                ->where('students.status', '=', 3)
                                ->where('students.committee_choice', '=' , $request->committee_id)
                                ->paginate(300);

        if (!$committee_member) {
            $response['status'] = false;
            $response['message'] = "Something went wrong !";
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
    $user = User::find($request->user_id);

    if (!$user) {
        $response['status'] = false;
        $response['message'] = "User not found";
        return $this->sendResponse($response);
    }

    // Update the user's password
    $user->password = Hash::make($request->password);
    $user->save();

    if ($user->id) {
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
    $profile = User::find($request->user_id);

    if (!$profile) {
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
        $profile->avatar = 'user_image/' . $fileName;
        $profile->save();

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
