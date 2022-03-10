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

class LiveController extends Controller
{
  public function __construct()
    {
      View::share('routeGroup','live');
    }
  
    public function index(Request $request)
    {
       
        $data = SiteIndexes::where('deleted_at', null)->where('type','live')->first(); 
        
        return view('admin/live/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'live_url' => 'required|max:255|url',
            
        ],[
            'live_url.required' => 'The Live URL field is required',
            'live_url.url' => 'The Live URL not url',
        ]);

        $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->live_url);

        $live = SiteIndexes::where('type','live')->first();
    
        if(!empty($youtubeurl)){
         
        $live->video = $youtubeurl;
        $live->type  = 'live';
        $live->save();
           
           if($live->id){
            Session::flash('success', 'Live Url updated successfully!');
            return redirect('/admin/live');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        }else{
            Session::flash('error', 'Check Your Youtube url correct!!');
            return  redirect()->back();
          }
           
    }

    
   
}
