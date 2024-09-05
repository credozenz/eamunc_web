<?php

namespace App\Http\Controllers\Api;

use App\Models\Committee;
use App\Models\Line_by_line;
use App\Models\Resolution;
use App\Models\Students;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Vienna_formula;

class LineByLineController extends IndexController
{

    public function get_line_by_line(Request $request)
    {

        $loguser = auth()->user();

        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();

        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        $line = Line_by_line::where('committe_id', $committee->id)->first();

        if (!$line) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $line;
            return $this->sendResponse($response);

        }
    }

    public function get_line_by_line_new(Request $request)
    {

        $loguser = auth()->user();

        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();

        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        $line = Line_by_line::where('committe_id', $committee->id)->first();
        $vienna = Vienna_formula::where('committe_id', $committee->id)->first();
        if($vienna){
            if ($line) {

            } 
            else {
                $line = new Line_by_line;
                $line->content = $vienna->content;
                $line->committe_id = $committee->id;
                $line->save();
            }
        }

        if (!$line) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $line;
            return $this->sendResponse($response);

        }
    }

    public function add_line_by_line(Request $request)
    {

        $validator = Validator::make($request->all(), ['line' => 'required']);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $loguser = auth()->user();

        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();

        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

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

        if ($line->id) {
            if ($loguser->role == 3) {
                $resolution = Resolution::where('committe_id', $committee->id)->first();

                if ($resolution) {
                    $resolution->content = $request->line;
                    $resolution->committe_id = $committee->id;
                    $resolution->save();
                }
            }
            $success['message'] = "line by line added successfully";
            $success['status'] = true;
            return $this->sendResponse($success);
        } else {
            $response['status'] = false;
            $response['message'] = "No line by line added. Check your input data.";
            return $this->sendResponse($response);
        }

    }

}
