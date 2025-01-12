<?php

namespace App\Http\Controllers\Api;

use App\Models\Committee;
use App\Models\Countries;
use App\Models\Students;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Image;
use League\Flysystem\File;
use Mail;
use Storage;
use Str;

class AuthController extends IndexController
{

    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), ['username' => 'required', 'password' => 'required', 'committee' => 'required']);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        $committee = Committee::where([['id', $request->committee], ['deleted_at', '=', '']])->first();

        $user = User::where('email', $request->username)->where('deleted_at', null)->whereIn('role', [2, 3, 4])->first();

        if (empty($user->id)) {
            $response['status'] = false;
            $response['message'] = "Unable to login - Unknown User";
            return $this->sendResponse($response);

        } else {

            if ($user->role == 2 || $user->role == 3) {

                $student = Students::where('user_id', $user->id)->first();
                $committee_id = $student->committee_choice;

                if ($request->committee == $committee_id) {

                    $committee = $committee_id;

                } else {

                    $response['status'] = false;
                    $response['message'] = "You are not a member of this committee. Kindly choose the right committee or contact a beaureau member for assistance.";
                    return $this->sendResponse($response);

                }

            } elseif ($user->role == 4) {

                $committee = $request->committee_id;

            }

            if (Hash::check($request->password, $user->password)) {

                // Generate and attach a new access token
                $token = $user->createToken('token');

                $user->token = $token->plainTextToken;

                $success['user'] = $user;
                $success['message'] = "Login Success";
                $success['status'] = true;
                return $this->sendResponse($success);

            } else {

                $response['status'] = false;
                $response['message'] = "Unable to login - Password incorrect";
                return $this->sendResponse($response);

            }

        }

    }

    public function logout(Request $request)
    {

        $token = $request->bearerToken();
        [$id, $user_token] = explode('|', $token, 2);
        $user_token = hash('sha256', $user_token);

        $token_status = DB::table('personal_access_tokens')->where('token', $user_token)->delete();

        if ($token_status) {
            $response['status'] = true;
            $response['message'] = "Successfully logged out.";
            return $this->sendResponse($response);
        } else {
            $response['status'] = false;
            $response['message'] = "Something went wrong!";
            return $this->sendResponse($response);
        }

    }

    public function get_profile(Request $request)
    {

        $loguser = auth()->user();

        $student = Students::where('user_id', 102)->where('deleted_at', null)->first();
        if (isset($student->country_choice)) {
            $country = Countries::where('id', $student->country_choice)->where('deleted_at', null)->first();
        }

        $loguser['phone_code'] = isset($student->phone_code) ? $student->phone_code : '';
        $loguser['whatsapp_no'] = isset($student->whatsapp_no) ? $student->whatsapp_no : '';
        $loguser['country_choice'] = isset($student->country_choice) ? $student->country_choice : '';
        $loguser['class'] = isset($student->class) ? $student->class : '';
        $loguser['country_name'] = isset($country->name) ? $country->name : '';

        if (!$loguser) {
            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $loguser;
            return $this->sendResponse($response);

        }
    }

    public function get_committee(Request $request)
    {

        $loguser = auth()->user();
        if ($loguser->role != 4) {
            $student = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where([['id', $student->committee_choice]])->first();
        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        if (!$committee) {
            $response['status'] = true;
            $response['data'] = (object) [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $committee;
            return $this->sendResponse($response);

        }
    }

    public function get_allcommittee(Request $request)
    {

        $committees = Committee::where([['deleted_at', null]])->paginate(300);

        if (!$committees) {
            $response['status'] = true;
            $response['data'] = [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $committees;
            return $this->sendResponse($response);

        }
    }

    public function get_committee_member(Request $request)
    {

        $loguser = auth()->user();
        if ($loguser->role != 4) {
            $user = Students::where('user_id', $loguser->id)->where('deleted_at', null)->first();
            $committee = Committee::where('id', $user->committee_choice)->first();
        } else {
            $committee = Committee::where([['id', $request->committee_id]])->first();
        }

        $committee_member = User::where('users.deleted_at', null)
            ->join('students', 'users.id', '=', 'students.user_id')
            ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
            ->join('countries', 'students.country_choice', '=', 'countries.id')
            ->select('users.*', 'schools.name as school_name', 'students.position', 'users.role', 'users.avatar', 'countries.name as country_name')
            ->where('students.status', '=', 3)
            ->where('students.committee_choice', '=', $committee->id)
            ->get();
        foreach ($committee_member as $key => $val) {
            if ($val->role === 2) {
                $committee_member[$key]->name = $val->country_name;
            }
        }

        if (!$committee_member) {
            $response['status'] = true;
            $response['data'] = [];
            return $this->sendResponse($response);

        } else {

            $response['status'] = true;
            $response['data'] = $committee_member;
            return $this->sendResponse($response);

        }
    }

    public function update_password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|string|min:8',
            'password_confirm' => 'required|same:password',
        ], [
            'password.min' => 'The password must be at least 8 characters long.',
            'password.string' => 'The password must be a string.',
            'password.required' => 'The password field is required.',
            'password_confirm.required' => 'The password confirmation field is required.',
            'password_confirm.same' => 'The password and password confirmation must match.',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        // Retrieve the user's profile
        $loguser = auth()->user();

        if (!$loguser) {
            $response['status'] = false;
            $response['message'] = "User not found";
            return $this->sendResponse($response);
        }

        // Update the user's password
        $loguser->password = Hash::make($request->password);
        $loguser->save();

        if ($loguser->id) {
            $response['status'] = true;
            $response['message'] = "Password updated successfully!";
            return $this->sendResponse($response);
        } else {
            $response['status'] = false;
            $response['message'] = "Something went wrong!";
            return $this->sendResponse($response);
        }
    }

    public function update_avatar(Request $request)
    {
        // Validate the request data
        $validator = Validator::make($request->all(), [
            'avatar' => ['image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'], // Reduce max size to 2MB (2048 KB)
        ], [
            'avatar.max' => 'Image must be smaller than 2 MB',
            'avatar.mimes' => 'Input accepts only jpeg, png, jpg, gif, svg images',
        ]);

        if ($validator->fails()) {
            return $this->sendError($validator->errors());
        }

        // Retrieve the user's profile
        $loguser = auth()->user();

        if (!$loguser) {
            $response['status'] = false;
            $response['message'] = "User not found";
            return $this->sendResponse($response);
        }

        if ($request->hasFile('avatar')) {
            // Handle avatar upload
            $image = $request->file('avatar');
            $extension = $image->getClientOriginalExtension();

            if ($extension === 'svg') {
                // For SVG images, no need for resizing
                $img = $image->get();
            } else {
                // For non-SVG images, resize and convert to PNG
                $width = 600;
                $height = 600;
                $img = Image::make($image->getRealPath());

                if ($img->height() > $img->width()) {
                    $width = null;
                } else {
                    $height = null;
                }

                $img->resize($width, $height, function ($constraint) {
                    $constraint->aspectRatio();
                });

                $img->encode('png'); // Convert to PNG format
            }

            // Store the image in the storage disk (public storage)
            $fileName = time() . '_' . str_random(5) . '_' . rand(1111, 9999) . '.png'; // Always store as PNG
            Storage::disk('public')->put('user_image/' . $fileName, $img, 'public');

            // Update the user's avatar path in the database
            $loguser->avatar = 'user_image/' . $fileName;
            $loguser->save();

            $response['status'] = true;
            $response['message'] = "Avatar updated successfully!";
            return $this->sendResponse($response);
        }

        // If no avatar file was provided
        $response['status'] = false;
        $response['message'] = "Something went wrong !";
        return $this->sendResponse($response);
    }

    public function RequestForgetPassword(Request $request)
    {

        $customMessages = [
            'email.exists' => 'The selected email does not exist in our records.',
        ];

        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                function ($attribute, $value, $fail) {
                    $user = DB::table('users')
                        ->where('email', $value)
                        ->whereNull('deleted_at')
                        ->where('status', 1)
                        ->first();

                    if (!$user) {

                        $response['status'] = false;
                        $response['message'] = 'The selected email (' . $value . ') does not exist in our records or the account is not active.';
                        return $this->sendResponse($response);

                    }
                },
            ],
        ], $customMessages);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now(),
        ]);

        $sent = Mail::send('admin.auth.forget-password-email', ['token' => $token], function ($message) use ($request) {
            $message->to(trim($request->email));
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');

        });

        $response['status'] = true;
        $response['message'] = 'We have emailed your password reset link!';
        return $this->sendResponse($response);

        // if ($sent > 0) {
        //     $response['status'] = true;
        //     $response['message'] = 'We have emailed your password reset link!';
        //     return $this->sendResponse($response);
        // } else {
        //     $response['status'] = false;
        //     $response['message'] = 'Something went wrong !';
        //     return $this->sendResponse($response);
        // }

    }

}
