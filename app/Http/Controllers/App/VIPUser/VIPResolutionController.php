<?php

namespace App\Http\Controllers\App\VIPUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helper\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\User;
use App\Models\Resolution;
use View;
class VIPResolutionController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','vipuser_resolution');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $resolution = Resolution::where('committe_id',$committee->id)->first();

        return view('app/vipuser/resolution', compact('committee','resolution'));
    }


    public function show()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $resolution = Resolution::where('committe_id',$committee->id)->first();

        return view('app/vipuser/resolution_editor', compact('committee','resolution'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'resolution'    => 'required',
        ],[
            'resolution.required' => 'The Resolution field is required', 
        ]);


        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();

        $resolution = Resolution::where('committe_id',$committee->id)->first();

            if($resolution){

                $resolution = Resolution::where('id', $resolution->id)->first(); 
                $resolution->content = $request->resolution;
                $resolution->committe_id = $committee->id;
                $resolution->save();

                    }else{

                $resolution = new Resolution;
                $resolution->content = $request->resolution;
                $resolution->committe_id = $committee->id;
                $resolution->save();
                
            }
            
        

            
        if($resolution->id){
            Session::flash('success', 'Resolution Submitted !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }




}
