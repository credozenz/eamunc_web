<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;

class FaqController extends Controller
{
    public function index()
    {
        

        $faq = SiteIndexes::where('deleted_at', null)->where('type', 'faq')->orderBy('id', 'DESC')->paginate(4); 

        return view('web/faq', compact('faq'));


    }
}
