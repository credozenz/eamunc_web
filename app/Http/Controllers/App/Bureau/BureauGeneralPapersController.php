<?php

namespace App\Http\Controllers\App\Bureau;

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
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\Bloc_chats;
use App\Models\User;
use App\Models\Paper_submission;
use Carbon\Carbon;
use View;
class BureauGeneralPapersController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','bureau_general_papers');

    }

    public function index(Request $request)
    {
        $member = WebAppHelper::getLogMember();
       
        $committee = Committee::where('id',$member->committee_choice)->first();

        $papers = Paper_submission::where('committe_id',$member->committee_choice)->get();

        $papers = DB::table('users as u')
                    ->join('paper_submissions as b', 'u.id', '=', 'b.user_id')
                    ->select('u.*','b.paper','b.id as paper_id')
                    ->where('u.deleted_at', null)
                    ->where('b.deleted_at', null)
                    ->where('b.committe_id', '=', $committee->id)
                    ->get();

       
        return view('app/bureau/general_papers', compact('member','committee','papers'));
    }



    public function destroy(Request $request,$id)
    {
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $speak = Paper_submission::where('id', $id)->update(['deleted_at'=>$timestamp]);

        echo json_encode(['status'=>true,'message'=>'Paper Deleted Successfully !']);exit();
    }


}
