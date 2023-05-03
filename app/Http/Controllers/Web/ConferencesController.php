<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;


class ConferencesController extends Controller
{
    public function index()
    {
        

        $letter = SiteIndexes::where('deleted_at', null)->where('type', 'letter')->orderBy('id', 'DESC')->paginate(4); 
        $work_members = SiteIndexes::where('deleted_at', null)->where('type', 'work_members')->orderBy('id', 'DESC')->paginate(12);
        $important_date = SiteIndexes::where('deleted_at', null)->where('type', 'important_date')->orderBy('id', 'DESC')->paginate(4);
        $rules = SiteIndexes::where('deleted_at', null)->where('type','rules')->first();
        
        return view('web/conferences', compact('letter','work_members','important_date','rules'));


    }

    public function conference_update_inner($id)
    {
        

        $conference_update = SiteIndexes::where('id', $id)->where('type', 'conference_update')->orderBy('id', 'DESC')->first(); 
        
        
        return view('web/conference_update_inner', compact('conference_update'));


    }
}
