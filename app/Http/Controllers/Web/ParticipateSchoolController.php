<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;

class ParticipateSchoolController extends Controller
{
    public function index()
    {
        $schools = SiteIndexes::where('deleted_at', null)->where('type', 'participate_schools')->orderBy('id', 'DESC')->paginate(4); 

        return view('web/participate-schools', compact('schools'));
    }

}
