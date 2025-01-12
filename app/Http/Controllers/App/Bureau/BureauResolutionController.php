<?php

namespace App\Http\Controllers\App\Bureau;

use App\Helpers\WebAppHelper;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Line_by_line;
use App\Models\Resolution;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use View;

class BureauResolutionController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();

        View::share('routeGroup', 'bureau_resolution');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $resolution = Resolution::where('committe_id', $committee->id)->first();

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        if($acceptedDelegatesArray){
            $acceptedDelegates = User::where('users.deleted_at', null)
            ->join('students', 'users.id', '=', 'students.user_id')
            ->join('countries', 'countries.id', '=', 'students.country_choice')
            ->leftJoin('schools', 'students.school_id', '=', 'schools.id')
            ->select('students.*', 'schools.name as school_name', 'users.role', 'users.avatar', 'countries.name as cntry_name')
            ->where('users.role', '=', 2)
            ->where('students.committee_choice', '=', $committee->id)
            ->where(function ($query) use ($acceptedDelegatesArray) {
                if (!empty($acceptedDelegatesArray)) {
                    $query->whereIn('students.user_id', $acceptedDelegatesArray);
                }
            })
            ->paginate(300);
        }else{
            $acceptedDelegates = [];
        }

        return view('app/bureau/resolution', compact('committee', 'resolution', 'acceptedDelegates'));
    }

    public function show()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $resolution = Resolution::where('committe_id', $committee->id)->first();
        if(!$resolution){
            $resolution = new Resolution;
            $resolution->content = '';
            $resolution->committe_id = $committee->id;
            $resolution->save();
        }
        $line = Line_by_line::where('committe_id', $committee->id)->first();
        if ($line) {
            if ($resolution) {
                // $resolution->content = $line->content;
                // $resolution->committe_id = $committee->id;
                // $resolution->save();
            } else {
                // $resolution = new Resolution;
                // $resolution->content = $line->content;
                // $resolution->committe_id = $committee->id;
                // $resolution->save();
            }
        }
        $resolution = Resolution::where('committe_id', $committee->id)->first();
        return view('app/bureau/resolution_editor', compact('committee', 'resolution', 'line'));
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'resolution' => 'required',
        ], [
            'resolution.required' => 'The Resolution field is required',
        ]);

        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $resolution = Resolution::where('committe_id', $committee->id)->first();

        if ($resolution) {

            $resolution = Resolution::where('id', $resolution->id)->first();
            $resolution->content = $request->resolution;
            $resolution->committe_id = $committee->id;
            $resolution->save();

        } else {

            $resolution = new Resolution;
            $resolution->content = $request->resolution;
            $resolution->committe_id = $committee->id;
            $resolution->save();

        }

        if ($resolution->id) {
            Session::flash('success', 'Resolution Submitted !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Something went wrong!!');
            return redirect()->back();
        }

    }

}
