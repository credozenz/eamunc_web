<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Students;
use Mail;
use Illuminate\Support\Str;
use View;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    public function __construct()
    {
        View::share('routeGroup','reset-password');
      
    }

  

    public function ForgetPassword() {
       
        return view('admin.auth.forget-password');
    }

    public function ForgetPasswordStore(Request $request) {
        
        $request->validate([
            'email' => 'required|email|exists:users',
        ], [
            'email.exists' => 'The selected email does not exist in our records.',
        ]);

        $token = Str::random(64);
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('admin.auth.forget-password-email', ['token' => $token], function($message) use($request){
            $message->to(trim($request->email));
            $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have emailed your password reset link!');
    }

    public function ResetPassword($token) {
        $reset_row = DB::table('password_resets')->where('token', $token)->first();

        return view('admin.auth.forget-password-link', ['token' => $token,'email' =>$reset_row->email ]);
    }
    
    public function ResetPasswordStore(Request $request) {
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
        ],[
            'email.required' => 'The email field is required',
            'email.exists' => 'Undefined email',
            'password.min' => 'The password min 8 required',
            'password.string' => 'The password include string',
            'password.required' => 'The password field is required',
            'password_confirmation.required' => 'The password confirmation field is required',
            'password_confirmation.same' => 'Password and confirm password must match',
        ]);

        $update = DB::table('password_resets')->where(['email' => trim($request->email), 'token' => $request->token])->first();

        if(!$update){
            
            return back()->with('message', 'Invalid credentials!');
        }

        
        $user = user::where('users.deleted_at', null)
                ->where('users.email', trim($request->email))
                ->first();
        $user->password  = Hash::make($request->password);
        $user->status  = 1;
        $user->save(); 


        $student = students::where('user_id', $user->id)->first();
        $student->status  = 3;
        $student->save();


        // Delete password_resets record
        DB::table('password_resets')->where(['email'=> trim($request->email)])->delete();

        return redirect('/app')->with('message', 'Your password has been successfully changed!');
    }
}