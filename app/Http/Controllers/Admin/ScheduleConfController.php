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
use App\Models\Conference_schedule;
use App\Models\Conference_schedule_time;
use App\Models\SiteIndexes;
use App\Http\Requests;
use Flash;
use Alert;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\File;

class ScheduleConfController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','home');
    }
    public function index(Request $request)
    {   
        $data = Conference_schedule::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/conferenceSchedule/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/conferenceSchedule/create');
    }

    
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'date' => 'required',
            'title' => 'required|max:255',
            "name" => 'required|array',
            'name.*' => 'required',
            "time_start" => 'required|array',
            'time_start.*' => 'required',
            "time_end" => 'required|array',
            'time_end.*' => 'required',
            // 'description' => 'required',
        ],[
            'date.required' => 'The Date field is required',
            'title.required' => 'The Title field is required',
            'name.required' => 'The Name field is required',
            'time_start.required' => 'The time start field is required',
            'time_end.required' => 'The time end field is required',
            // 'description.required' => 'The Description field is required',
        ]);

      
        $schedule = new Conference_schedule;
        $schedule->title = $request->title;
        $schedule->date  = date('Y-m-d',strtotime($request->date));
        $schedule->description = $request->title;//$request->description;
        $schedule->save();

        $name = $request->input('name');
        $start_time = $request->input('time_start');
        $end_time = $request->input('time_end');
       
        //$insert_schedule=array();

    for($count = 0; $count < count($name); $count++)
    {
        if(!empty($name[$count])){
        $data = array(
                'name' => $name[$count],
                'time_start'  => $start_time[$count],
                'time_end'    => $end_time[$count],
                'schedule_id' => $schedule->id,
              );
        Conference_schedule_time::insert($data);
       // $insert_schedule[] = $data; 
            }

        
     }
     
    


        if($schedule->id){
            Session::flash('success', 'Schedule added successfully!');
            return redirect('/admin/conference_schedule');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = Conference_schedule::find($id); 
        $time = Conference_schedule_time::where('schedule_id', $id)->get(); 
        return view('admin/conferenceSchedule/show', compact('data','time'));
    }

   
    public function edit($id)
    {
        $data = Conference_schedule::find($id); 
        $time = Conference_schedule_time::where('schedule_id', $id)->get(); 
       
        return view('admin/conferenceSchedule/edit',compact('data','time'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'date' => 'required',
            'title' => 'required|max:255',
            //'description' => 'required',
        ],[
            'date.required' => 'The Date field is required',
            'title.required' => 'The Title field is required',
            //'description.required' => 'The Description field is required',
        ]);

    
        $schedule = Conference_schedule::where('id', $id)->first(); 
        $schedule->title = $request->title;
        $schedule->date  = $request->date;
        $schedule->description = $request->title;//$request->description;
        
        $schedule->save();

        $name = $request->input('name');
        $start_time = $request->input('time_start');
        $end_time = $request->input('time_end');

        //$insert_schedule=array();

        if(count($name) > 0){
        $res = Conference_schedule_time::where('schedule_id', $id)->delete();
        }

    for($count = 0; $count < count($name); $count++)
    {
        if(!empty($name[$count])){
                $data = array(
                        'name' => $name[$count],
                        'time_start'  => $start_time[$count],
                        'time_end'    => $end_time[$count],
                        'schedule_id' => $schedule->id,
                    );

                //$insert_schedule[] = $data; 
                Conference_schedule_time::insert($data);
            }
     }
     
    //  if(!empty($insert_schedule)){
    //     $res = Conference_schedule_time::where('schedule_id', $id)->delete();
    //     if($res){
    //         Conference_schedule_time::insert($insert_schedule);
    //     }
    //  }
     

        
        if($schedule->id){
            Session::flash('success', 'Schedule updated successfully!');
            return redirect('/admin/conference_schedule');
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }

           
    }

    
    public function destroy(Request $request,$id)
    {

        $news = Conference_schedule::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Schedule Deleted Successfully !']);exit();
    }
}
