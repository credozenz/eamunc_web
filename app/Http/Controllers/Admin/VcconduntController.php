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

class VcconduntController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','vc_condunt');
    }
  
    public function index(Request $request)
    {
       
        $data = SiteIndexes::where('deleted_at', null)->where('type','vc_condunt')->first(); 
        
        return view('admin/vcCondunt/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
            'doc_file' => ['mimes:pdf', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'doc_file.max' => 'File  must be smaller than 2 MB',
            'doc_file.mimes' => 'Input accept only pdf',
        ]);

    
         
        $type_data = SiteIndexes::where('type','vc_condunt')->first(); 

        if(!empty($type_data)){
            $condunt = SiteIndexes::where('type','vc_condunt')->first();
        }else{
            $condunt = new SiteIndexes;
        }
        $condunt->title = $request->title;
        $condunt->description  = $request->description;
        $condunt->type  = 'vc_condunt';
       
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(1080,480, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('vc_condunts/'.$fileName,$img,'public');

            $condunt->image = 'vc_condunts/'.$fileName; 
           }


        if ($request->hasFile('doc_file')) {
            $doc = $request->file('doc_file');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
          
            $extension=$doc->getClientOriginalExtension();
           
            $file = $doc->get();
            
          
            Storage::disk('public')->put('vc_condunts/doc/'.$docfileName,$file,'public');

            $condunt->file = 'vc_condunts/doc/'.$docfileName; 
           }


           $condunt->save();
           
           if($condunt->id){
            Session::flash('success', 'Code Of Conduct messages updated successfully!');
            return redirect('/admin/vc_condunt');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
