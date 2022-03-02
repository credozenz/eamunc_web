<?php

namespace App\Http\Controllers\Webapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function index()
    {
        return view('Webapp.login');
    }


    public function login(Request $request)
    {
        
        if($request->email != '' && $request->password != '')
        {
            $admin = DB::table('users')
                        ->where('email', $request->email)
                        ->where('status', 1);
                        
            if($admin->count() > 0)
            {
                $admin = $admin->first();
                if(Hash::check($request->password,$admin->password))
                {
                    $datas['ID']   = $admin->id;
                    $datas['ROLE'] = $admin->role;
                    $datas['NAME'] = $admin->name;
                    $datas['EMAIL'] = $admin->email;
                    Session::put($datas);

                return redirect('webapp/dashboard'); 
                 
                }
                else
                {
                    return redirect()->back()->with('not_found','Invalid Login');
                }
            }
            else
            {

                return redirect()->back()->with('not_found','Invalid Login');
            }
        }
        else
        {
            return redirect()->back()->with('fill','Both fields have to be filled');
        }
    }

  
}


