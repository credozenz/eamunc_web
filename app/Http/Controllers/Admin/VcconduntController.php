<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\Vc_condunt;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class VcconduntController extends Controller
{
  
    public function index(Request $request)
    {
       
        $data = Vc_condunt::find(1); 
        
        return view('admin/vcCondunt/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            'doc_file' => ['mimes:pdf', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'doc_file.max' => 'File  must be smaller than 2 MB',
            'doc_file.mimes' => 'Input accept only pdf',
        ]);

    
        $condunt = Vc_condunt::where('id', 1)->first(); 
        $condunt->title = $request->title;
        $condunt->description  = $request->description;
        
       
        
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
            
            Storage::disk('public')->put('vc_condunts/'.$fileName,$img,'public');

            $condunt->image = 'vc_condunts/'.$fileName; 
           }


        if ($request->hasFile('doc_file')) {
            $doc = $request->file('doc_file');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
          
            $extension=$doc->getClientOriginalExtension();
           
            $file = $doc->get();
            
          
            Storage::disk('public')->put('vc_condunts/doc/'.$docfileName,$file,'public');

            $condunt->doc_file = 'vc_condunts/doc/'.$docfileName; 
           }


           $condunt->save();
           
           if($condunt->id){
            Session::flash('success', 'Virtual Code Of Conduct messages updated successfully!');
            return redirect('/admin/vc_condunt');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
