<?php

namespace App\Http\Controllers\App\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebAppHelper;
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

class DelegateScheduleProgramController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','delegate_dashbord');
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

                           
        return view('app/delegate/program_schedule', compact('program_schedule','committee'));
    }

    
   
}
