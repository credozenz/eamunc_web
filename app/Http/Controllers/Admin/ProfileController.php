<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\User;

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

    public function update_profile()
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

    
        $news = User::where('id', 1)->first(); 
        $news->name = $request->name;
        $news->email = $request->email;
        
       
        
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

            $news->avatar = 'user_image/'.$fileName; 
           }

           $news->save();
           
           
           return  redirect()->back()->with('status',"Profile updated successfully"); 
    }


   
    public function change_password()
    {
        
    }

   
}
