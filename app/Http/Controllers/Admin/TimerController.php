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

class TimerController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','home');
    }
    
    public function index(Request $request)
    {
        $data = SiteIndexes::where('deleted_at', null)->where('type','timer')->first(); 
      
        return view('admin/timer/index', compact('data'));
       
    }

    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'date' => 'required|max:255',
        ],[
            'title.required' => 'The Title field is required',
            'date.required' => 'The Date field is required',
        ]);
    
        $timer = SiteIndexes::where('type', 'timer')->first(); 
        $timer->title = $request->title;
        $timer->date = $request->date;
        $timer->type = 'timer';
        $timer->save();
           
        if($timer->id){
        Session::flash('success','Timer updated successfully!');
        return redirect('/admin/timer');
        }else{
        Session::flash('error', 'Something went wrong!!');
        return  redirect()->back();
        }
           
    }

    
   
}
