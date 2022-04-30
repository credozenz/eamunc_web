<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getLogin()
    {
        
        return view('app/login');
    }


    public function postLogin(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'password' => ['required'],
        ],[
            'email.required' => 'The Email field is required',
            'password.required' => 'The Password field is required',
        ]);

        if($request->email != '' && $request->password != '')
        {
            $users = DB::table('users')
                        ->where('email', $request->email);
                  
            if($users->count() > 0)
            {
                $user = $users->first();
                
                if(Hash::check($request->password,$user->password))
                {
                   
                    $datas['Log_ID']    = $user->id;
                    $datas['Log_ROLE']  = $user->role;
                    $datas['Log_NAME']  = $user->name;
                    $datas['Log_EMAIL'] = $user->email;
                    Session::put($datas);

               
                return redirect('/app/dashbord'); 
  
                }else{
                    Session::flash('error', 'Something went wrong!');
                    return redirect()->back();
                }
            }else{

                return redirect()->back()->with('not_found','Invalid Login');
            }
        }else{
            return redirect()->back()->with('fill','Both fields have to be filled');
        }
    }

  
}


