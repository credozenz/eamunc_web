<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Students;
use App\Models\Countries;
use App\Models\Committee;
use App\Models\User;
use App\Models\Alumni_registration;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Str;
use Mail;
use Image;
use Storage;
use League\Flysystem\File;

class AlumniRegController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','alumni_reg');
    }
    
 
    public function index(Request $request)
    {

        $query = Alumni_registration::where('alumni_registration.deleted_at', null)
        ->select('alumni_registration.*');
        
        if($request->q){
            $query->where('alumni_registration.name','LIKE', $request->q)
            ->orwhere('alumni_registration.name','LIKE', $request->q)
            ->orwhere('alumni_registration.email','LIKE', $request->q)
            ->orwhere('alumni_registration.phone_no','LIKE', $request->q);
        }

        
        $data = $query ->orderBy('alumni_registration.id', 'desc')
        ->paginate(10);


       
        return view('admin/alumni_reg/index', compact('data','request'));
       
    }

 



}
