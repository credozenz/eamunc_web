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
use App\Models\Vienna_formula;
use View;
class VIPViennaFormulaController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','vipuser_vienna_formula');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $vienna = Vienna_formula::where('committe_id',$committee->id)->first();

        return view('app/vipuser/vienna_formula', compact('committee','vienna'));
    }


    public function show()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();

        $vienna = Vienna_formula::where('committe_id',$committee->id)->first();
       
        return view('app/vipuser/vienna_formula_editor', compact('vienna','committee'));
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'vienna'    => 'required',
        ],[
            'vienna.required' => 'The vienna field is required', 
        ]);


        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();

        $vienna = Vienna_formula::where('committe_id',$committee->id)->first();

            if($vienna){

        $vienna = Vienna_formula::where('id', $vienna->id)->first(); 
        $vienna->content = $request->vienna;
        $vienna->committe_id = $committee->id;
        $vienna->save();

            }else{

        $vienna = new Vienna_formula;
        $vienna->content = $request->vienna;
        $vienna->committe_id = $committee->id;
        $vienna->save();
                
            }
            
        

            
        if($vienna->id){
            Session::flash('success', 'Vienna Formula Submitted !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }





}
