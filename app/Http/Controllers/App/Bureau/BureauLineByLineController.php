<?php

namespace App\Http\Controllers\App\Bureau;

use App\Helpers\WebAppHelper;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Line_by_line;
use App\Models\Resolution;
use App\Models\Vienna_formula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use View;

class BureauLineByLineController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();

        View::share('routeGroup', 'bureau_line_by_line');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $line = Line_by_line::where('committe_id', $committee->id)->first();

        return view('app/bureau/line_by_line', compact('committee', 'line'));
    }

    public function show()
    {

        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id', $member->committee_choice)->first();
        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();
        $line = Line_by_line::where('committe_id', $committee->id)->first();
        if($vienna){
            if ($line) {
                // $line->content = $vienna->content;
                // $line->committe_id = $committee->id;
                // $line->save();
            } 
            else {
                $line = new Line_by_line;
                $line->content = $vienna->content;
                $line->committe_id = $committee->id;
                $line->save();
            }
        }
        $line = Line_by_line::where('committe_id', $committee->id)->first();
        return view('app/bureau/line_by_line_editor', compact('committee', 'line', 'vienna'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'line' => 'required',
        ], [
            'line.required' => 'The line field is required',
        ]);

        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $line = Line_by_line::where('committe_id', $committee->id)->first();

        if ($line) {

            $line = Line_by_line::where('id', $line->id)->first();
            $line->content = $request->line;
            $line->committe_id = $committee->id;
            $line->save();

        } else {

            $line = new Line_by_line;
            $line->content = $request->line;
            $line->committe_id = $committee->id;
            $line->save();

        }

        $resolution = Resolution::where('committe_id', $committee->id)->first();

        if ($resolution) {
            $resolution->content = $request->line;
            $resolution->committe_id = $committee->id;
            $resolution->save();
        } 
        // else {

        //     $resolution = new Resolution;
        //     $resolution->content = $request->line;
        //     $resolution->committe_id = $committee->id;
        //     $resolution->save();

        // }

        if ($line->id) {
            Session::flash('success', 'line by line Submitted !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Something went wrong!!');
            return redirect()->back();
        }

    }

}
