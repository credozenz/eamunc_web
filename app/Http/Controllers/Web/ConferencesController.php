<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;


class ConferencesController extends Controller
{
    public function index()
    {
        

        $letter = SiteIndexes::where('deleted_at', null)->where('type', 'letter')->orderBy('id', 'DESC')->paginate(4); 
        $work_members = SiteIndexes::where('deleted_at', null)->where('type', 'work_members')->orderBy('id', 'DESC')->paginate(20);
        $important_date = SiteIndexes::where('deleted_at', null)->where('type', 'important_date')->orderBy('id', 'DESC')->paginate(4);
        $rules = SiteIndexes::where('deleted_at', null)->where('type','rules')->first();
        
        return view('web/conferences', compact('letter','work_members','important_date','rules'));


    }
}
