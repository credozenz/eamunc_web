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

class RulesController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','conference');
    }
  
    public function index(Request $request)
    {
        $data = SiteIndexes::where('deleted_at', null)->where('type','rules')->first(); 
      
        return view('admin/rules/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'file' => ['mimes:pdf', 'max:255']
        ],[
            'title.required' => 'The Title field is required',
            'file.max' => 'Image  must be smaller than 2 MB',
            'file.mimes' => 'Input accept only pdf',
        ]);

    
         

        $type_data = SiteIndexes::where('type','rules')->first(); 

        if(!empty($type_data)){
            $rules = SiteIndexes::where('type', 'rules')->first();
        }else{
            $rules = new SiteIndexes;
        }

        $rules->title = $request->title;
        $rules->type  = 'rules';
       
        
        if ($request->hasFile('file')) {
            $doc = $request->file('file');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get(); 
          
            Storage::disk('public')->put('rules/'.$docfileName,$file,'public');

            $rules->file = 'rules/'.$docfileName; 
           }

           $rules->save();
           
           if($rules->id){
            Session::flash('success', 'Rules and Regulations updated successfully!');
            return redirect('/admin/rules');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
