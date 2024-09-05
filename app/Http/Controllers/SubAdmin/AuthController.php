<?php

namespace App\Http\Controllers\SubAdmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function getLogin()
    {
        return view('subadmin/login');
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
            $admin = DB::table('users')
                        ->where('email', $request->email)
                        ->where('deleted_at', null)
                        ->where('role', 9)
                        ->first();
                
            if(!empty($admin->id))
            {
                
                if(Hash::check($request->password,$admin->password))
                {
                   
                    $datas['ID']   = $admin->id;
                    $datas['ROLE'] = $admin->role;
                    $datas['NAME'] = $admin->name;
                    $datas['EMAIL'] = $admin->email;
                    Session::put($datas);
                    

               
                return redirect('/subadmin/dashbord'); 
  
                }
                else
                {
                    Session::flash('error', 'Invalid Password !');
                    return redirect()->back();
                }
            }
            else
            {
                Session::flash('error', 'Invalid login credentials');
                return redirect()->back();
            }
        }
        else
        {
            Session::flash('error', 'Required!,Username and Password fields have to be filled');
            return redirect()->back();
        }
    }

  
}


