<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\AdminHelper;
use App\Models\SiteIndexes;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class AlumniController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','alumni');
    }
  
    public function index(Request $request)
    {
        $data = SiteIndexes::where('deleted_at', null)->where('type','alumni')->first(); 
      
        return view('admin/alumni/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2055']
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

    
        
        
        $type_data = SiteIndexes::where('type','alumni')->first(); 
        
        if(!empty($type_data)){
            $alumni = SiteIndexes::where('type', 'alumni')->first(); 
        }else{
            $alumni = new SiteIndexes;
        }


        $alumni->title = $request->title;
        $alumni->description  = $request->description;
        $alumni->type  = 'alumni';
       
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(1080,476, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('alumni/'.$fileName,$img,'public');

            $alumni->image = 'alumni/'.$fileName; 
           }

           $alumni->save();
           
           if($alumni->id){
            Session::flash('success', 'Alumni updated successfully!');
            return redirect('/admin/alumni');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
