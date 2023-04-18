<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;

class NewsLetterController extends Controller
{
  
    public function index()
    {
        

        $newsletter = SiteIndexes::where('deleted_at', null)->where('type', 'news_letter')->orderBy('id', 'DESC')->paginate(4); 
        return view('web/newsletter', compact('newsletter'));


    }

}
