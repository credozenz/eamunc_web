<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;

class VirtualCodeController extends Controller
{
    public function index()
    {
        $virtualcode = SiteIndexes::where('deleted_at', null)->where('type','vc_condunt')->first(); 

        return view('web/virtualcode-conduct', compact('virtualcode'));
    }
}
