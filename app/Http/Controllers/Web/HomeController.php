<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Conference_schedule;
use App\Models\Conference_schedule_time;

class HomeController extends Controller
{
    
    public function index()
    {
        $banner = SiteIndexes::where('deleted_at', null)->where('type', 'banner')->orderBy('id', 'ASC')->paginate(10); 
       
        $timer = SiteIndexes::where('deleted_at', null)->where('type','timer')->first();  
        $president_messages = SiteIndexes::where('deleted_at', null)->where('type','president_messages')->first(); 
        $faculties_messages = SiteIndexes::where('deleted_at', null)->where('type', 'faculties_messages')->orderBy('id', 'DESC')->paginate(10);
        $our_mentors = SiteIndexes::where('deleted_at', null)->where('type', 'our_mentors')->orderBy('id', 'DESC')->paginate(20);
        $conference_update = SiteIndexes::where('deleted_at', null)->where('type', 'conference_update')->orderBy('id', 'DESC')->paginate(12); 
        
        $schedule = Conference_schedule::where('deleted_at', null)->where('date', '>=', date('Y-m-d'))->orderBy('id', 'ASC')->paginate(10);
  
        $conference_schedule = $schedule->map(function($item, $key) {

            $time = Conference_schedule_time::where('schedule_id', $item->id)->get();
                                return [
                                    'id' => $item->id,
                                    'date' => $item->date,
                                    'title' => $item->title,
                                    'time' => $time,
                                ];
                            });
             
      

        return view('web/home', compact('banner','timer','president_messages','faculties_messages','our_mentors','conference_update','conference_schedule'));
    }

    
}
