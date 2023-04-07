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
use App\Models\Resolution;
use App\Models\User;
use View;

class VIPGeneralAssemblyController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','vipuser_general_assembly');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $general_assembly = DB::table('resolution as r')
                                ->join('committees as c', 'r.committe_id', '=', 'c.id')
                                ->select('r.*','c.title as committee_title')
                                ->where('r.deleted_at', null)
                                ->where('c.deleted_at', null)
                                ->get();

        return view('app/vipuser/general_assembly', compact('committee','general_assembly'));
    }

    public function show(Request $request,$id)
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $general_assembly = DB::table('resolution as r')
                                ->join('committees as c', 'r.committe_id', '=', 'c.id')
                                ->select('r.*','c.title as committee_title')
                                ->where('r.deleted_at', null)
                                ->where('r.id', $id)
                                ->where('c.deleted_at', null)
                                ->first();

        return view('app/vipuser/general_assembly_show', compact('committee','general_assembly'));
    }




}
