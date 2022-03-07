<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\Live;

use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class LiveController extends Controller
{
  
    public function index(Request $request)
    {
       
        $data = Live::find(1); 
        
        return view('admin/live/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'live_url' => 'required|max:255',
            
        ],[
            'live_url.required' => 'The Live URL field is required',
        ]);

    
        $live = Live::where('id', 1)->first();
        $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->live_url);
        $live->live_url  = $youtubeurl;
        $live->save();
           
           if($live->id){
            Session::flash('success', 'Live Url updated successfully!');
            return redirect('/admin/live');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
