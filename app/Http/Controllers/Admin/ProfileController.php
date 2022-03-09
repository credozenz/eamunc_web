<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\User;
use App\Models\SiteIndexes;
use App\Http\Requests;
 use Flash;
use Alert;
use Carbon\Carbon;
use Str;
use Image;
use Storage;

use League\Flysystem\File;

class ProfileController extends Controller
{
    
    public function profile()
    {
        $data = User::find(1); 
        
        return view('admin/profile/profile_edit', compact('data'));
  
    }

    public function update_profile(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255']
        ],[
            'name.required' => 'The Name field is required',
            'email.required' => 'The Post field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

    
        $profile = User::where('id', 1)->first(); 
        $profile->name = $request->name;
        $profile->email = $request->email;
        
       
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(100, 100, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('user_image/'.$fileName,$img,'public');

            $profile->avatar = 'user_image/'.$fileName; 
           }

           $profile->save();
           
           
           if($profile->id){
            Session::flash('success', 'Profile updated successfully!');
            return redirect('/admin/profile');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
    }


   
    public function change_password()
    {

        $data = User::find(1); 
        
        return view('admin/profile/change_password', compact('data'));
  
        
    }


    public function update_password(Request $request)
    {

        $validatedData = $request->validate([
            'password' => 'required|max:255',
            'new_password' => 'required|max:255',
            'confirm_password' => 'required|max:255|same:new_password',
        ],[
            'password.required' => 'The Password field is required',
            'new_password.required' => 'The New password field is required',
            'confirm_password.required' => 'The Confirm password field is required',
            'confirm_password.same' => 'Confirm password not match!',
        ]);

    
        $user = User::where('id', 1)->first(); 

        if(Hash::check($request->password,$user->password)){

        $user->password = Hash::make($request->new_password);
        $user->save();
           
           
           if($user->id){
            Session::flash('success', 'Password updated successfully!');
            return redirect('/admin/change_password');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        }else{

            Session::flash('error', 'Current Password wrong!!');
            return  redirect()->back();
        }
    }

   
}
