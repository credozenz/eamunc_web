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
                        ->where('email', $request->email)
                        ->whereIn('role', [2,3]);
                      
            if($users->count() > 0)
            {
                
                $user = $users->first();
               
                if(Hash::check($request->password,$user->password))
                {
                   
                    $member_datas['Log_ID']    = $user->id;
                    $member_datas['Log_ROLE']  = $user->role;
                    $member_datas['Log_NAME']  = $user->name;
                    $member_datas['Log_EMAIL'] = $user->email;
                    $member_datas['Log_IMG']   = $user->avatar;

                    Session::put($member_datas);
                  
                    if($user->role=='2'){
                        return redirect('/app/delegate_dashbord');
                    }elseif($user->role=='3'){
                        return redirect('/app/bureau_dashbord');
                    }
                    
  
                }
                else
                {
                    Session::flash('error', 'Invalid Password !');
                    return redirect()->back();
                }
            }
            else
            {
                Session::flash('error', 'Not found !,invalid login credentials');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Required !,Username and Password fields have to be filled');
            return redirect()->back();
        }
    }

  
}


