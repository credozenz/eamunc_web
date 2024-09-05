<?php

namespace App\Http\Controllers\App\Delegate;

use App\Helpers\WebAppHelper;
use App\Http\Controllers\Controller;
use App\Models\Committee;
use App\Models\Resolution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use View;

class DelegateResolutionController extends Controller
{

    public function __construct()
    {
        $routeName = Route::currentRouteName();

        View::share('routeGroup', 'delegate_resolution');

    }

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $resolution = Resolution::where('committe_id', $committee->id)->first();

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        $newDelegateId = $member->user_id;
        $accepted = false;
        if (!empty($resolution->accepted_delegates)) {
            if (in_array($newDelegateId, $acceptedDelegatesArray)) {
                $accepted = true;
            }

        }

        return view('app/delegate/resolution', compact('committee', 'resolution', 'accepted'));
    }

    public function load_resolution()
    {
        $member = WebAppHelper::getLogMember();
        $committee = Committee::where('id', $member->committee_choice)->first();

        $resolution = Resolution::where('committe_id', $committee->id)->first();

        if ($resolution) {
            $status = "1";
            $message = '';
            $dt = '<textarea id="view_editor" type="text" class="form-control">' . $resolution->content . '</textarea>';
            $resolution = $dt;
        } else {
            $status = "0";
            $message = "Something went wrong";
        }
        echo json_encode(['status' => $status, 'message' => $message, 'content' => $resolution]);
    }

    public function accept(Request $request)
    {

        $member = WebAppHelper::getLogMember();

        $committee = Committee::where('id', $member->committee_choice)->first();

        $resolution = Resolution::where('committe_id', $committee->id)->first();

        $acceptedDelegatesArray = isset($resolution->accepted_delegates) ? explode(',', $resolution->accepted_delegates) : [];

        $newDelegateId = $member->user_id;

        if (!empty($resolution->accepted_delegates)) {
            if (!in_array($newDelegateId, $acceptedDelegatesArray)) {
                $acceptedDelegatesArray[] = $newDelegateId;
            }

            $acceptedDelegates = implode(',', $acceptedDelegatesArray);
        } else {
            $acceptedDelegates = $newDelegateId;
        }

        $resolution = Resolution::where('id', $resolution->id)->first();
        $resolution->accepted_delegates = $acceptedDelegates;
        $resolution->save();

        if ($resolution->id) {
            Session::flash('success', 'Resolution Accepted !');
            return redirect()->back();
        } else {
            Session::flash('error', 'Something went wrong!!');
            return redirect()->back();
        }

    }

}
