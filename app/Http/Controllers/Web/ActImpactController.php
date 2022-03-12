<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;


class ActImpactController extends Controller
{
   
    public function index()
    {
        

        $impact = SiteIndexes::where('deleted_at', null)->where('type','act_impact')->first(); 

        return view('web/act-to-impact', compact('impact'));


    }

    
}
