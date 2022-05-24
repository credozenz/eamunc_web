<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;

class HostSchoolController extends Controller
{
    public function index()
    {
        $schools = SiteIndexes::where('deleted_at', null)->where('type', 'host_schools')->orderBy('id', 'DESC')->paginate(10); 

        return view('web/host-schools', compact('schools'));
    }

}
