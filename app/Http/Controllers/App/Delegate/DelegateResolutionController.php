<?php

namespace App\Http\Controllers\App\Delegate;

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
use App\Models\Resolution;
use View;

class DelegateResolutionController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','delegate_resolution');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $resolution = Resolution::where('committe_id',$committee->id)->first();

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        $newDelegateId = $member->id;
        $accepted = false;
       if(!empty($resolution->accepted_delegates)){
            if (!in_array($newDelegateId, $acceptedDelegatesArray)) {
                $accepted = true;           
            }

        }

        return view('app/delegate/resolution', compact('committee','resolution','accepted'));
    }



    public function accept(Request $request)
    {

    
        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();

        $resolution = Resolution::where('committe_id',$committee->id)->first();

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        $newDelegateId = $member->id;
        
        if(!empty($resolution->accepted_delegates)){
            if (!in_array($newDelegateId, $acceptedDelegatesArray)) {
                $acceptedDelegatesArray[] = $newDelegateId;           
            }

            $acceptedDelegates = implode(',', $acceptedDelegatesArray);
        }else{
            $acceptedDelegates = $newDelegateId;
        }
        

        
        
        $resolution = Resolution::where('id', $resolution->id)->first(); 
        $resolution->accepted_delegates = $acceptedDelegates;
        $resolution->save();
              
        

            
        if($resolution->id){
            Session::flash('success', 'Resolution Accepted !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }







}
