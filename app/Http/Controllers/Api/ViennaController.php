<?php

namespace App\Http\Controllers\Api;

use App\Models\Committee;
use App\Models\Delegate_vienna_formula;
use App\Models\Line_by_line;
use App\Models\Students;
use App\Models\User;
use App\Models\Vienna_formula;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ViennaController extends IndexController
{

    public function get_vienna(Request $request)
    {
        $loguser = auth()->user();

        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();

        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();

        if (!$vienna) {

            $response['status'] = true;
            $response['data'] = (object) [];
            $response['deligates_vienna'] = null;
            $response['my_vienna'] = null;
            return $this->sendResponse($response);

        } else {
            if ($loguser->role == 3) {
                $deligates_vienna = Delegate_vienna_formula::select('delegate_vienna_formula.content', 'countries.name as cntry_name')->where('committe_id', $committee->id)->join('students', 'delegate_vienna_formula.user_id', '=', 'students.user_id')->join('countries', 'countries.id', '=', 'students.country_choice')->get();
            } else {
                $deligates_vienna = null;
            }

            if ($loguser->role == 2) {
                $my_vienna = Delegate_vienna_formula::where('committe_id', $committee->id)->where('user_id', $loguser->id)->first();

            } else {
                $my_vienna = null;
            }

            $response['status'] = true;
            $response['data'] = $vienna;
            $response['deligates_vienna'] = $deligates_vienna;
            $response['my_vienna'] = $my_vienna;
            return $this->sendResponse($response);

        }
    }

    public function get_vienna_new(Request $request)
    {

        $loguser = auth()->user();

        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();

        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();

        if(!$vienna){
            $vienna = new Vienna_formula;
            $vienna->content = '';
            $vienna->committe_id = $committee->id;
            $vienna->save();
        }

        if (!$vienna) {

            $response['status'] = true;
            $response['data'] = (object) [];
            $response['deligates_vienna'] = null;
            $response['my_vienna'] = null;
            return $this->sendResponse($response);

        } else {
            if ($loguser->role == 3) {
                $deligates_vienna = Delegate_vienna_formula::select('delegate_vienna_formula.content', 'countries.name as cntry_name')->where('committe_id', $committee->id)->join('students', 'delegate_vienna_formula.user_id', '=', 'students.user_id')->join('countries', 'countries.id', '=', 'students.country_choice')->get();
            } else {
                $deligates_vienna = null;
            }

            if ($loguser->role == 2) {
                $my_vienna = Delegate_vienna_formula::where('committe_id', $committee->id)->where('user_id', $loguser->id)->first();

            } else {
                $my_vienna = null;
            }

            $response['status'] = true;
            $response['data'] = $vienna;
            $response['deligates_vienna'] = $deligates_vienna;
            $response['my_vienna'] = $my_vienna;
            return $this->sendResponse($response);

        }
    }

    public function add_vienna(Request $request)
    {

        $validator = Validator::make($request->all(), ['vienna' => 'required']);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();

        $committee = Committee::where('id', $user->committee_choice)->first();

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
        

        if ($vienna->id) {
            if ($loguser->role == 3) {
                $line = Line_by_line::where('committe_id', $committee->id)->first();
                if ($line) {
                    $line->content = $request->vienna;
                    $line->committe_id = $committee->id;
                    $line->save();
                }
            }
            $success['message'] = "Vienna added successfully";
            $success['status'] = true;
            return $this->sendResponse($success);
        } else {
            $response['status'] = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
        }

    }

    public function add_delegate_vienna(Request $request)
    {

        $validator = Validator::make($request->all(), ['vienna' => 'required']);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();

        $committee = Committee::where('id', $user->committee_choice)->first();

        $vienna = Delegate_vienna_formula::where('committe_id', $committee->id)->where('user_id', $loguser->id)->first();

        if ($vienna) {
            $vienna = Delegate_vienna_formula::where('id', $vienna->id)->first();
            $vienna->content = $request->vienna;
            $vienna->committe_id = $committee->id;
            $vienna->save();

        } else {

            $vienna = new Delegate_vienna_formula;
            $vienna->content = $request->vienna;
            $vienna->committe_id = $committee->id;
            $vienna->user_id = $loguser->id;
            $vienna->save();

        }

        if ($vienna->id) {
            $success['message'] = "Vienna added successfully";
            $success['status'] = true;
            return $this->sendResponse($success);
        } else {
            $response['status'] = false;
            $response['message'] = "Something went wrong!!";
            return $this->sendResponse($response);
        }

    }

}
