<?php

namespace App\Http\Controllers\Api;

use App\Models\Blocs;
use App\Models\Bloc_chats;
use App\Models\Bloc_members;
use App\Models\Committee;
use App\Models\Students;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Image;
use League\Flysystem\File;
use Storage;

class BlockController extends IndexController
{

    public function get_blocks(Request $request)
    {
        $loguser = auth()->user();

        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();
            $committee_bloc = Blocs::where('committe_id', $user->committee_choice)->where('deleted_at', null)->get();

            $loguserbloc = Bloc_members::where('user_id', $loguser->id)->where('deleted_at', null)->first();

            foreach ($committee_bloc as $key => $bloc) {
                if (isset($loguserbloc->bloc_id)) {
                    if ($bloc->id === $loguserbloc->bloc_id) {
                        // Set a flag to true for the matching bloc
                        $committee_bloc[$key]->user_block = true;
                    } else {
                        // Set a flag to false for non-matching blocs
                        $committee_bloc[$key]->user_block = false;
                    }
                } else {
                    $committee_bloc[$key]->user_block = false;
                }
            }

        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
            $committee_bloc = Blocs::where('committe_id', $committee->id)->where('deleted_at', null)->get();
        }

        if (!$committee_bloc) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $committee_bloc;
            return $this->sendResponse($response);

        }
    }

    public function add_blocks(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "member_id" => "required|array",
            "member_id.*" => "required",
            "name" => 'required|max:255',
        ]);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
        $committee = Committee::where('id', $user->committee_choice)->first();

        $user_id = $request->member_id;

        $name = $request->name;

        $bloc = new blocs;
        $bloc->name = $name;
        $bloc->committe_id = $committee->id;
        $bloc->save();

        for ($count = 0; $count < count($user_id); $count++) {

            $bloc_member = new Bloc_members;
            $bloc_member->user_id = $user_id[$count];
            $bloc_member->bloc_id = $bloc->id;
            $bloc_member->save();

        }

        if (!empty($bloc_member->id)) {

            $success['message'] = "Bloc added successfully";
            $success['status'] = true;
            return $this->sendResponse($success);

        } else {

            $response['status'] = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);

        }

    }

    public function get_block_members(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "block_id" => "required",
        ]);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $bloc_members = DB::table('bloc_members as b')
            ->join('users as u', 'b.user_id', '=', 'u.id')
            ->join('students as s', 'b.user_id', '=', 's.user_id')
            ->join('countries as c', 's.country_choice', '=', 'c.id')
            ->select('b.*', 'c.name as country_choice', 'u.name as user_name', 's.position', 'u.avatar as avatar')
            ->where('u.deleted_at', null)
            ->where('b.deleted_at', null)
            ->where('b.bloc_id', '=', $request->block_id)
            ->orderBy('b.id', 'ASC')
            ->get();
        foreach ($bloc_members as $key => $val) {
            $bloc_members[$key]->user_name = $val->country_choice;
        }
        if (!$bloc_members) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $bloc_members;
            return $this->sendResponse($response);

        }
    }

    public function get_addblock_members(Request $request)
    {

        $loguser = auth()->user();

        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
        $committee = Committee::where('id', $user->committee_choice)->first();

        $committee_members = DB::table('users as u')
            ->join('students as s', 'u.id', '=', 's.user_id')
            ->join('countries', 'countries.id', '=', 's.country_choice')
            ->select('u.*', 'countries.name as cntry_name')
            ->where('s.status', '=', 3)
            ->where('u.role', '=', 2)
            ->where('u.deleted_at', null)
            ->where('s.committee_choice', '=', $committee->id)
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('bloc_members as bm')
                    ->whereRaw('u.id = bm.user_id')
                    ->where('bm.deleted_at', null);
            })
            ->get();

        foreach ($committee_members as $key => $val) {
            $committee_members[$key]->name = $val->cntry_name;
        }
        if (!$committee_members) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $committee_members;
            return $this->sendResponse($response);

        }
    }

    public function delete_blocks(Request $request)
    {

        $block = blocs::where('id', $request->block_id)->first();
        $mytime = Carbon::now();
        $timestamp = $mytime->toDateTimeString();
        $block->deleted_at = $timestamp;
        $block->save();

        if (!$block) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            Bloc_members::where('bloc_id', $request->block_id)->update(['deleted_at' => $timestamp]);
            Bloc_chats::where('bloc_id', $request->block_id)->update(['deleted_at' => $timestamp]);
            $response['status'] = true;
            $response['data'] = "Bloc successfully deleted";
            return $this->sendResponse($response);

        }
    }
    public function close_block(Request $request)
    {
        $bloc = Blocs::where('id', $request->block_id)->first();
        $bloc->is_closed = 1;
        $bloc->save();
        $success['message'] = "Bloc closed successfully";
        $success['status'] = true;
        return $this->sendResponse($success);
    }

    public function is_block_closed(Request $request)
    {
        $bloc = Blocs::where('id', $request->id)->first();
        if($bloc->is_closed == 1){  
            $success['message'] = "Bloc is closed";
            $success['status'] = true;
            return $this->sendResponse($success);
        }else{
            $response['status'] = false;
            $response['message'] = "Bloc is not closed";
            return $this->sendResponse($response);
        }
    }
    public function update_blocks(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "member_id" => "required|array",
            "member_id.*" => "required",
            "name" => 'required|max:255',
            "block_id" => 'required',
        ]);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $loguser = auth()->user();
        $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
        $committee = Committee::where('id', $user->committee_choice)->first();

        $user_id = $request->member_id;
        $block_id = $request->block_id;
        $name = $request->name;

        $bloc = Blocs::where('id', $block_id)->first();
        $bloc->name = $name;
        $bloc->committe_id = $committee->id;
        $bloc->save();

        if (count($user_id) > 0) {

            $mytime = Carbon::now();
            $timestamp = $mytime->toDateTimeString();
            $blocmem = Bloc_members::where('bloc_id', $block_id)->update(['deleted_at' => $timestamp]);

            for ($count = 0; $count < count($user_id); $count++) {

                $bloc_member = new Bloc_members;
                $bloc_member->user_id = $user_id[$count];
                $bloc_member->bloc_id = $block_id;
                $bloc_member->save();

            }

            if (!empty($bloc_member->id)) {

                $success['message'] = "Bloc update successfully";
                $success['status'] = true;
                return $this->sendResponse($success);

            } else {

                $response['status'] = false;
                $response['message'] = "No Bloc added. Check your input data.";
                return $this->sendResponse($response);

            }

        } else {

            $response['status'] = false;
            $response['message'] = "Something went wrong!";
            return $this->sendResponse($response);
        }

    }

    public function get_block_chat(Request $request)
    {

        $blocs_chats = DB::table('bloc_chats as b')
            ->join('users as u', 'b.user_id', '=', 'u.id')
            ->join('students as s', 'u.id', '=', 's.user_id')
            ->join('countries', 'countries.id', '=', 's.country_choice')
            ->select('b.*', 'u.name as user_name', 'u.avatar as avatar', 'countries.name as cntry_name')
            ->where('u.deleted_at', null)
            ->where('b.deleted_at', null)
            ->where('b.bloc_id', '=', $request->block_id)
            ->orderBy('b.id', 'DESC')
            ->paginate(10);
        foreach ($blocs_chats as $key => $val) {
            $blocs_chats[$key]->user_name = $val->cntry_name;
        }
        if (!$blocs_chats) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $blocs_chats;
            return $this->sendResponse($response);

        }
    }

    public function add_block_chat(Request $request)
    {

        $validator = Validator::make($request->all(), [
            "message" => 'required',
        ]);

        if ($validator->fails()) {

            $response['status'] = false;
            $response['message'] = 'Validation Error: ' . $validator->errors();
            return $this->sendResponse($response);

        }

        $loguser = auth()->user();
        $student = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
        $committee = Committee::where([['id', $student->committee_choice]])->first();

        $user_id = $student->user_id;
        $committe_id = $committee->id;
        $bloc_id = $request->block_id;

        $message = $request->message;
        $type = 'text';

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . str_random(5) . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();

            if (in_array($extension, ['svg', 'png', 'jpg', 'jpeg', 'gif'])) {
                $type = 'image';

                if ($extension == 'svg') {
                    $img = $file->get();
                } else {
                    $img = Image::make($file->getRealPath());
                    $img->resize(1296, 845, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream('png', 100);
                }

            } else if (in_array($extension, ['doc', 'docx', 'pdf', 'xls', 'xlsx'])) {
                $type = 'file';
                $img = $file->get();
            } else {
                Session::flash('error', 'Handle unsupported file formats!!');
                return redirect()->back();
            }

            Storage::disk('public')->put('chat/' . $fileName, $img, 'public');
            $message = 'chat/' . $fileName;

        }

        $chat = new Bloc_chats;
        $chat->bloc_id = $bloc_id;
        $chat->user_id = $user_id;
        $chat->committe_id = $committe_id;
        $chat->message = $message;
        $chat->type = $type;
        $chat->save();

        if (!$chat->id) {

            $response['status'] = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = ['chat_id' => $chat->id];
            return $this->sendResponse($response);

        }

    }

    public function delete_block_chat(Request $request)
    {

        $chat = Bloc_chats::where('id', $request->message_id)->first();
        $mytime = Carbon::now();
        $timestamp = $mytime->toDateTimeString();
        $chat->deleted_at = $timestamp;
        $chat->save();

        if (!$chat) {

            $response['status'] = false;
            $response['message'] = "Something went wrong !";
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = "Chat successfully deleted";
            return $this->sendResponse($response);

        }
    }

    public function delete_block_member(Request $request)
    {
        $mytime = Carbon::now();
        $timestamp = $mytime->toDateTimeString();
        $bloc = Bloc_members::where('bloc_id', $request->block_id)->where('user_id', $request->user_id)->update(['deleted_at' => $timestamp]);

        if (!$bloc) {

            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = "Bloc member successfully deleted";
            return $this->sendResponse($response);

        }
    }

}
