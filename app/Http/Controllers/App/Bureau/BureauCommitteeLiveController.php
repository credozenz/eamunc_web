<?php

namespace App\Http\Controllers\App\Bureau;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helpers\WebAppHelper;
use App\Helpers\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\Images;
use App\Models\User;
use Carbon\Carbon;
use View;
use Str;
use Image;
use Storage;
use League\Flysystem\File;
class BureauCommitteeLiveController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','committee_live');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();

        $committee_bloc = Blocs::where('committe_id',$member->committee_choice)->get();

        $committee_member = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->select('u.*')
                                ->where('s.status', '=', 3)
                                ->where('u.role', '=', 2)
                                ->where('u.deleted_at', null)
                                ->where('s.committee_choice', '=' , $committee->id)
                                ->whereNotExists(function($query)
                                        {
                                            $query->select(DB::raw(1))
                                                ->from('bloc_members as bm')
                                                ->whereRaw('u.id = bm.user_id')
                                                ->where('bm.deleted_at', null);
                                        })
                                ->get();

        $committee_lives = Images::where('connect_id', $committee->id)->where('type', 'app_committee_live')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(12);
       

        return view('app/bureau/committee_live', compact('committee','committee_member','committee_bloc','committee_lives'));
    }




    public function update(Request $request, $id)
    {

       
        $validatedData = $request->validate([
            'live_url' =>'required|max:255',
        ],[
            'live_url.required' => 'The live url field is required',
        ]);

    
           $committee = Committee::where('id', $id)->first();

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->live_url);
           
           $committee->live_url  = $youtubeurl;
            
           $committee->save();
          
          if($committee->id){
            Session::flash('success', 'Live Url updated successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }


    }


    public function add(Request $request, $id)
    {

       
        $validatedData = $request->validate([
            'live_url' =>'required|max:255',
        ],[
            'live_url.required' => 'The live url field is required',
        ]);

        $committee = Committee::where('id', $id)->first();

        $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->live_url);

        $gallery = new Images;
        $gallery->type = 'app_committee_live';
        $gallery->connect_id = $committee->id;
        $gallery->video = $youtubeurl;
        $gallery->save();

        if($gallery->id){
            Session::flash('success', 'Video added successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

    }



    

    public function live_delete(Request $request,$id)
    {

        $gallery = Images::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $gallery->deleted_at = $timestamp;
        $gallery->save();

        echo json_encode(['status'=>true,'message'=>'Live Video Deleted Successfully !']);exit();
    }



}
