<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\Committee_member;



class CommitteesController extends Controller
{
    public function index()
    {
        

        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 

        return view('web/committees', compact('committees'));


    }

    public function index_inner($id)
    {
        

        $committees = Committee::find($id); 
        $members = DB::table('users as u')
        ->leftjoin('committee_members as cm', 'cm.user_id', '=', 'u.id')
        ->select('u.*')
        ->where('u.deleted_at', null)
        ->where('u.role','3')
        ->where('committe_id', $id)
        ->paginate(20);
        // $members = Committee_member::where('committe_id', $id)->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(20);
        return view('web/committees-inner', compact('committees','members'));


    }
}
