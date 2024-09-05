<?php

namespace App\Http\Controllers\App\Delegate;

use App\Helpers\WebAppHelper;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Delegate_vienna_formula;
use App\Models\Vienna_formula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use View;

class DelegateViennaFormulaController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();

        View::share('routeGroup', 'delegate_vienna_formula');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $main_vienna = Vienna_formula::where('committe_id', $committee->id)->first();
        $vienna = Delegate_vienna_formula::where('committe_id', $committee->id)->where('user_id', $member->user_id)->first();

        return view('app/delegate/vienna_formula', compact('committee', 'vienna', 'main_vienna'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'vienna' => 'required',
        ], [
            'vienna.required' => 'The vienna field is required',
        ]);

        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $vienna = Delegate_vienna_formula::where('committe_id', $committee->id)->where('user_id', $member->user_id)->first();

        if ($vienna) {

            $vienna = Delegate_vienna_formula::where('id', $vienna->id)->first();
            $vienna->content = $request->vienna;
            $vienna->committe_id = $committee->id;
            $vienna->save();

        } else {

            $vienna = new Delegate_vienna_formula;
            $vienna->content = $request->vienna;
            $vienna->committe_id = $committee->id;
            $vienna->user_id = $member->user_id;
            $vienna->save();

        }

        if ($vienna->id) {
            Session::flash('success', 'Vienna Formula Submitted !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Something went wrong!!');
            return redirect()->back();
        }

    }

    public function load_main_vienna(){
        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id', $member->committee_choice)->first();
        
        $main_vienna = Vienna_formula::where('committe_id', $committee->id)->first();

        if ($main_vienna) {
            $status = "1";
            $message = '';
            $dt = '<textarea id="view_editor" type="text" class="form-control" style="height: auto;">'.$main_vienna->content.'</textarea>';
            $main_vienna = $dt;
        } else {
            $status = "0";
            $message = "Something went wrong";
        }
        echo json_encode(['status' => $status, 'message' => $message,'main_vienna' => $main_vienna]);
    }
}
