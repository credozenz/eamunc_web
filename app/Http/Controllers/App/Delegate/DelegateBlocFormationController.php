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
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\User;
use Carbon\Carbon;
use View;
class DelegateBlocFormationController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','delegate_bloc_formation');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();

        $committee_bloc = DB::table('blocs as b')
                            ->join('bloc_members as m', 'b.id', '=', 'm.bloc_id')
                            ->select('b.*')
                            ->where('b.committe_id',$member->committee_choice)
                            ->where('m.user_id','!=',$member->user_id)
                            ->where('b.deleted_at', null)
                            ->where('m.deleted_at', null)
                            ->get();

        $mybloc = DB::table('blocs as b')
                            ->join('bloc_members as m', 'b.id', '=', 'm.bloc_id')
                            ->select('b.*')
                            ->where('b.committe_id',$member->committee_choice)
                            ->where('m.user_id','=',$member->user_id)
                            ->where('b.deleted_at', null)
                            ->where('m.deleted_at', null)
                            ->first();

      
       

        return view('app/delegate/bloc_formation', compact('committee','committee_bloc','mybloc'));
    }



   


    public function show(Request $request,$id)
    {
       
        $blocs = Blocs::where('id',$id)->first();

        $blocs_members = DB::table('users as u')
                            ->join('bloc_members as b', 'u.id', '=', 'b.user_id')
                            ->select('u.*')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->get();
       
        $committee_member = DB::table('users as u')
                                ->join('students as s', 'u.id', '=', 's.user_id')
                                ->select('u.*')
                                ->where('s.status', '=', 3)
                                ->where('u.deleted_at', null)
                                ->where('s.committee_choice', '=' , $blocs->committe_id)
                                ->whereNotExists(function($query)
                                        {
                                            $query->select(DB::raw(1))
                                                ->from('bloc_members as bm')
                                                ->whereRaw('u.id = bm.user_id')
                                                ->where('bm.deleted_at', null);
                                        })
                                ->get();

        return view('app/delegate/bloc_show', compact('blocs','blocs_members','committee_member'));
    }


    


}
