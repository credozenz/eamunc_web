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

class GuidelineController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','guideline');
    }
  
    public function index(Request $request)
    {
       
        $data = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first(); 
        
        return view('admin/guideline/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'doc_file' => ['mimes:pdf', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'doc_file.max' => 'File  must be smaller than 2 MB',
            'doc_file.mimes' => 'Input accept only pdf',
        ]);

    
        $condunt = SiteIndexes::where('type','guideline')->first(); 
        $condunt->title = $request->title;
        $condunt->description  = $request->description;
        $condunt->type  = 'guideline';
       
        
      


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
            Session::flash('success', 'Guideline updated successfully!');
            return redirect('/admin/guideline');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
