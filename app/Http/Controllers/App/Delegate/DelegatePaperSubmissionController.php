<?php

namespace App\Http\Controllers\App\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helper\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Paper_submission;
use App\Models\Committee;
use App\Models\User;
use View;
use Str;
use Image;
use Storage;
use League\Flysystem\File;
class DelegatePaperSubmissionController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','delegate_paper_submission');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $guideline = SiteIndexes::where('deleted_at', null)->where('type','guideline')->first();

        $committee = Committee::where('id',$member->committee_choice)->first();

        $paper = Paper_submission::where('user_id',$member->user_id)->first();

        return view('app/delegate/paper_submission', compact('guideline','committee','paper'));
    }



    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'paper' => ['mimes:pdf,doc,docx', 'max:255']
        ],[
            'paper.max' => 'Image  must be smaller than 2 MB',
            'paper.mimes' => 'Input accept only pdf,doc,docx',
        ]);

        $member = WebAppHelper::getLogMember();
        

        if ($request->hasFile('paper')) {
            $image      =  $request->file('paper');
            
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            $img = $image->get();
           
            Storage::disk('public')->put('paper/'.$fileName,$img,'public');

            $paper = new Paper_submission;
            $paper->committe_id = $member->committee_choice;
            $paper->user_id     = $member->user_id;
            $paper->paper       = 'paper/'.$fileName; 
            $paper->paper_name  = $image->getClientOriginalName(); 
            $paper->save();
           
         
           if($paper->id){
            Session::flash('success', 'Paper submit successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        
    }
















}
