<?php

namespace App\Http\Controllers\App\Bureau;

use App\Helpers\WebAppHelper;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Delegate_vienna_formula;
use App\Models\Line_by_line;
use App\Models\Vienna_formula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use View;

class BureauViennaFormulaController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();

        View::share('routeGroup', 'bureau_vienna_formula');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();

        return view('app/bureau/vienna_formula', compact('committee', 'vienna'));
    }

    public function show()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();
        if(!$vienna){
            $vienna = new Vienna_formula;
            $vienna->content = '';
            $vienna->committe_id = $committee->id;
            $vienna->save();
        }
        $deligatevienna = Delegate_vienna_formula::select('delegate_vienna_formula.*', 'countries.name as cntry_name')->where('committe_id', $committee->id)->join('students', 'delegate_vienna_formula.user_id', '=', 'students.user_id')->join('countries', 'countries.id', '=', 'students.country_choice')->get();
        return view('app/bureau/vienna_formula_editor', compact('vienna', 'committee', 'deligatevienna'));
    }
    public function load_delegate_vienna(){
        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id', $member->committee_choice)->first();
        $deligatevienna = Delegate_vienna_formula::select('delegate_vienna_formula.*', 'countries.name as cntry_name')->where('committe_id', $committee->id)->join('students', 'delegate_vienna_formula.user_id', '=', 'students.user_id')->join('countries', 'countries.id', '=', 'students.country_choice')->get();
        if ($deligatevienna) {
            $status = "1";
            $message = '';
            $deligatevienna = str_replace(array("\r", "\n"), '', view("app/bureau/load_delegate_vienna", compact('deligatevienna')));
        } else {
            $status = "0";
            $message = "Something went wrong";
        }
        echo json_encode(['status' => $status, 'message' => $message,'deligatevienna' => $deligatevienna]);
    }

    public function close(Vienna_formula $vf)
    {
        $vf->is_closed = 1;
        $vf->save();
        return response()->json(['status' => true, 'message' => 'Vienna Formula closed successfully']);
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

        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();

        if ($vienna) {

            $vienna = Vienna_formula::where('id', $vienna->id)->first();
            $vienna->content = $request->vienna;
            $vienna->committe_id = $committee->id;
            $vienna->save();

        } else {

            $vienna = new Vienna_formula;
            $vienna->content = $request->vienna;
            $vienna->committe_id = $committee->id;
            $vienna->save();

        }

        $line = Line_by_line::where('committe_id', $committee->id)->first();

        if ($line) {
            $line->content = $request->vienna;
            $line->committe_id = $committee->id;
            $line->save();
        } 
       
        if ($vienna->id) {
            Session::flash('success', 'Vienna Formula Submitted !');
            return response()->json(['success' => true, 'message' => 'Vienna Formula Submitted !']);
        } else {
            Session::flash('error', 'Something went wrong!!');
            return response()->json(['success' => false, 'message' => 'Something went wrong!!']);
        }

    }

}
