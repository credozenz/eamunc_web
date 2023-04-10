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
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\User;
use Carbon\Carbon;
use View;
class VIPCommitteeLiveController extends Controller
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



        return view('app/vipuser/committee_live', compact('committee','committee_member','committee_bloc'));
    }





}
