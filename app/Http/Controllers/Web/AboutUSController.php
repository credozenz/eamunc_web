<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;




class AboutUSController extends Controller
{
   
    public function index()
    {
        
        $vision = SiteIndexes::where('deleted_at', null)->where('type','vision')->first(); 
        $mission = SiteIndexes::where('deleted_at', null)->where('type','mission')->first(); 
        $our_mentors = SiteIndexes::where('deleted_at', null)->where('type', 'our_mentors')->orderBy('id', 'DESC')->paginate(8);

        return view('web/about-us', compact('vision','mission','our_mentors'));


    }

   
   
}
