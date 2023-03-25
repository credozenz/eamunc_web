<?php

namespace App\Http\Controllers\App\VIPUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebAppHelper;
use App\Models\Committee;
use App\Models\Program_schedule;
use App\Models\Program_schedule_time;
use App\Http\Requests;
use Flash;
use Alert;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Illuminate\Support\Facades\Validator;
use League\Flysystem\File;

class VIPScheduleProgramController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','vipuser_dashbord');
    }
    public function index(Request $request)
    {   
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();

        $schedule = Program_schedule::where('deleted_at', null)->orderBy('id', 'ASC')->paginate(25);
  
        $program_schedule = $schedule->map(function($item, $key) {

        $time = Program_schedule_time::where('schedule_id', $item->id)->get();
                                return [
                                    'id' => $item->id,
                                    'date' => $item->date,
                                    'time' => $time,
                                ];
                            }); 

                           
        return view('app/vipuser/program_schedule/index', compact('program_schedule','committee'));
    }

    
    public function create()
    {
        return view('app/vipuser/program_schedule/create');
    }

    
    public function store(Request $request)
    {

        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $validatedData = $request->validate([
            "date" => 'required',
            "title"    => "required|array",
            "title.*"  => "required",
            "time_start"    => "required|array",
            "time_start.*"  => "required",
            "time_end"    => "required|array",
            "time_end.*"  => "required",
        ],[
            'date.required' => 'The Date field is required',
            'title.required' => 'The Title field is required',
            'time_start.required' => 'The start time field is required',
            'time_end.required' => 'The end time field is required',
        ]);

     
        $schedule = new Program_schedule;
        $schedule->committe_id = $committee->id;
        $schedule->date  = date('Y-m-d',strtotime($request->date));
        $schedule->save();

        $title = $request->input('title');
        $start_time = $request->input('time_start');
        $end_time = $request->input('time_end');
       
        $insert_schedule=array();

    for($count = 0; $count < count($title); $count++)
    {
        if(!empty($title[$count])){
        $data = array(
                'title' => $title[$count],
                'time_start'  => $start_time[$count],
                'time_end'    => $end_time[$count],
                'schedule_id' => $schedule->id,
              );

        $insert_schedule[] = $data; 
            }
     }
     
     Program_schedule_time::insert($insert_schedule);


        if($schedule->id){
            Session::flash('success', 'Schedule added successfully!');
            return redirect('/app/vipuser_program_schedule');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

  

    
    public function destroy(Request $request,$id)
    {

        $news = Program_schedule::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Schedule Deleted Successfully !']);exit();
    }
}
