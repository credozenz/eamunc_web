<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class VisionController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','about');
    }
  
    public function index(Request $request)
    {
       
        $data = SiteIndexes::where('deleted_at', null)->where('type','vision')->first(); 
        
        return view('admin/vision/index', compact('data'));
       
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

    
        $vision = SiteIndexes::where('type','vision')->first(); 
        $vision->title = $request->title;
        $vision->description  = $request->description;
        $vision->type  = 'vision';
       
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(440, 654, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('vision/'.$fileName,$img,'public');

            $vision->image = 'vision/'.$fileName; 
           }


           $vision->save();
           
           if($vision->id){
            Session::flash('success', 'Vision updated successfully!');
            return redirect('/admin/vision');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
