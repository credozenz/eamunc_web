<?php

namespace App\Http\Controllers\App\VIPUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helpers\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\User;
use App\Models\Line_by_line;
use View;
class VIPLineByLineController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','vipuser_line_by_line');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $line = Line_by_line::where('committe_id',$committee->id)->first();


        return view('app/vipuser/line_by_line', compact('committee','line'));
    }

    public function show()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $line = Line_by_line::where('committe_id',$committee->id)->first();


        return view('app/vipuser/line_by_line_editor', compact('committee','line'));
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'line'    => 'required',
        ],[
            'line.required' => 'The line field is required', 
        ]);


        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();

        $line = Line_by_line::where('committe_id',$committee->id)->first();

            if($line){

                $line = Line_by_line::where('id', $line->id)->first(); 
                $line->content = $request->line;
                $line->committe_id = $committee->id;
                $line->save();

                    }else{

                $line = new Line_by_line;
                $line->content = $request->line;
                $line->committe_id = $committee->id;
                $line->save();
                
            }
            
        

            
        if($line->id){
            Session::flash('success', 'line by line Submitted !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }



}
