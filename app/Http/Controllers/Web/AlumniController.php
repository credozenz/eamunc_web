<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;

class AlumniController extends Controller
{

    public function alumni_news_inner($id)
    {
        

         $alumni_news = SiteIndexes::where('id', $id)->where('type', 'alumni_news')->first(); 
        
        return view('web/alumni-news', compact('alumni_news'));


    }
  
    public function index()
    {
        

        $alumni = SiteIndexes::where('deleted_at', null)->where('type','alumni')->first(); 
        $alumni_news = SiteIndexes::where('deleted_at', null)->where('type', 'alumni_news')->orderBy('id', 'DESC')->paginate(4); 
        return view('web/alumni', compact('alumni','alumni_news'));


    }

}
