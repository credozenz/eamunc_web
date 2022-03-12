<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;


class RegistrationController extends Controller
{
    public function index()
    {
        $data ='';

        return view('web/registration', compact('data'));
    }

    public function hs_registration()
    {
        $data ='';

        return view('web/host-school-registration', compact('data'));
    }

    public function isg_registration()
    {
        $data ='';

        return view('web/isg-registration', compact('data'));
    }
}
