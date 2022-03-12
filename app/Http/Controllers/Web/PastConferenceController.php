<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;

class PastConferenceController extends Controller
{
    public function index()
    {
        $data ='';

        return view('web/past-conferences', compact('data'));
    }

    public function index_inner()
    {
        $data ='';

        return view('web/past-conferences-inner', compact('data'));
    }
}
