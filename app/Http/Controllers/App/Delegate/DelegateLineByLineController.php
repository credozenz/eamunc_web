<?php

namespace App\Http\Controllers\App\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helpers\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\User;
use App\Models\Line_by_line;
use View;
class DelegateLineByLineController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
       
        View::share('routeGroup','delegate_line_by_line');
       
    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $line = Line_by_line::where('committe_id',$committee->id)->first();


        return view('app/delegate/line_by_line', compact('committee','line'));
    }

    public function load_line_by_line(){
        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id', $member->committee_choice)->first();
        
        $line = Line_by_line::where('committe_id',$committee->id)->first();

        if ($line) {
            $status = "1";
            $message = '';
            $dt = '<textarea id="view_editor" type="text" class="form-control">'.$line->content.'</textarea>';
            $line = $dt;
        } else {
            $status = "0";
            $message = "Something went wrong";
        }
        echo json_encode(['status' => $status, 'message' => $message,'content' => $line]);
    }
}
