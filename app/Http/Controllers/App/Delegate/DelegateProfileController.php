<?php

namespace App\Http\Controllers\App\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helper\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\Countries;
use App\Models\User;
use View;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class DelegateProfileController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','delegate_profile');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50); 
       
        $countries = Countries::all();

        return view('app/delegate/profile', compact('guideline','committees','countries','member'));
    }


    public function update_password(Request $request)
    {

        $request->validate([
            'password' => 'required|string|min:8',
            'password_confirm' => 'required|same:password'
        ],[
            'password.min' => 'The Password min 8 required',
            'password.string' => 'The Password include string',
            'password.required' => 'The Password field is required',
            'password_confirm.required' => 'The Password confirmation field is required',
            'password_confirm.same' => 'Password and Confirm Password must match',
        ]);

    

        $member = WebAppHelper::getLogMember();
        $user = User::where('id', $member->user_id)->first(); 

        $user->password = Hash::make($request->password);
        $user->save();
           
           
           if($user->id){
            Session::flash('success', 'Password updated successfully!');
            return redirect('/app/delegate_profile');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        
    }



    public function update_avatar(Request $request)
    {

        $validatedData = $request->validate([
            'avatar' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255']
        ],[
            'avatar.max' => 'Image  must be smaller than 2 MB',
            'avatar.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $member = WebAppHelper::getLogMember();
        $profile = User::where('id', $member->user_id)->first(); 
       
        if ($request->hasFile('avatar')) {
            $image = $request->file('avatar');
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
            Session::flash('success', 'Profile Image updated successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        
    }

    public function log_out()
    {
        Session::flush();
       return redirect('/app');
    }


}
