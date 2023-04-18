<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;

class LiveController extends Controller
{
    public function index()
    {
        $live = SiteIndexes::where('deleted_at', null)->where('type','live')->first(); 

        return view('web/live', compact('live'));
    }

}
