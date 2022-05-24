<?php
namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class ParticipateSchoolController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','participateschools');
    }
  
    public function index(Request $request)
    {   
        $schools = SiteIndexes::where('deleted_at', null)->where('type', 'participate_schools')->orderBy('id', 'DESC')->paginate(10); 
        return view('web/participate-schools', compact('schools'));
    }

    
   
}
