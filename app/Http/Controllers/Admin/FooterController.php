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

class FooterController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','footer');
    }
  
  
    public function terms(Request $request)
    {
       
        $data = SiteIndexes::where('deleted_at', null)->where('type','terms')->first(); 
        
        return view('admin/footer/terms', compact('data'));
       
    }

   
    public function terms_update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
        ]);

    
        $terms = SiteIndexes::where('type','terms')->first(); 
        $terms->title = $request->title;
        $terms->description  = $request->description;
        $terms->type  = 'terms';
        $terms->save();
           
          if($terms->id){
            Session::flash('success', 'Terms of Service updated successfully!');
            return redirect('/admin/terms');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    public function privacy_policy(Request $request)
    {
       
        $data = SiteIndexes::where('deleted_at', null)->where('type','policy')->first(); 
        
        return view('admin/footer/privacy_policy', compact('data'));
       
    }

   
    public function privacy_policy_update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
        ]);

    
        $policy = SiteIndexes::where('type','policy')->first(); 
        $policy->title = $request->title;
        $policy->description  = $request->description;
        $policy->type  = 'policy';
        $policy->save();
           
          if($policy->id){
            Session::flash('success', 'Privacy policy updated successfully!');
            return redirect('/admin/privacy_policy');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }
    
   
}
