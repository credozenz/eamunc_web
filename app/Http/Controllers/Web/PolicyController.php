<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;

class PolicyController extends Controller
{

    public function privacy_policy()
    {
        $privacy_policy = SiteIndexes::where('deleted_at', null)->where('type', 'policy')->first(); 
        return view('web/privacy-policy', compact('privacy_policy'));
    }

    public function terms_service()
    {
        $terms_service = SiteIndexes::where('deleted_at', null)->where('type', 'terms')->first(); 
        return view('web/terms-service', compact('terms_service'));
    }


    
}
