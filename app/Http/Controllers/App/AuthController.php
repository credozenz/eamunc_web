<?php

namespace App\Http\Controllers\App;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Committee;
use App\Models\Students;

class AuthController extends Controller
{

   

    public function getLogin(Request $request,$committee)
    {

        $log_member = Session::get('Log_ID');
        

        if (!empty($log_member)) {

            $log_role = Session::get('Log_ROLE');

            if ($log_role == 2) {
                return redirect('/app/delegate_dashbord');
            } elseif ($log_role == 3) {
                return redirect('/app/bureau_dashbord');
            } elseif ($log_role == 4) {

                Session::put('Committee_ID', $committee);

                return redirect('/app/vipuser_dashbord');
            }

        }else{
            $committee = Committee::where('id',$committee)->first();
            return view('app/login',compact('committee'));
        }
       
    }

    public function getApp(Request $request)
    {

        $log_member = Session::get('Log_ID');
        

        if (!empty($log_member)) {

            $log_role = Session::get('Log_ROLE');

            if ($log_role == 2) {
                  return redirect('/app/delegate_dashbord');
            } elseif ($log_role == 3) {
                return redirect('/app/bureau_dashbord');
            } elseif ($log_role == 4) {
                $committees = Committee::where('deleted_at', null)->orderBy('position', 'ASC')->paginate(16); 
                return view('app/committees',compact('committees'));
            }
            
        }else{
            $committees = Committee::where('deleted_at', null)->orderBy('position', 'ASC')->paginate(16); 
            return view('app/committees',compact('committees'));
        }
        
    }


    public function postLogin(Request $request)
    {

        $validatedData = $request->validate([
            'email' => 'required|max:255',
            'password' => ['required'],
            'committee_id' => 'required|max:255',
        ],[
            'email.required' => 'The Email field is required',
            'password.required' => 'The Password field is required',
        ]);
      
        if($request->email != '' && $request->password != '')
        {
            $user = DB::table('users')
                        ->where('email', $request->email)
                        ->whereIn('role', [2,3,4])
                        ->first();
                        
            if(!empty($user->id))
            {


                
                if($user->role == 2 || $user->role == 3){
                    $student   = students::where('user_id', $user->id)->first(); 
                    $committee_id = $student->committee_choice;

                    if($request->committee_id == $committee_id){

                        $committee = $committee_id;

                    }else{
                        Session::flash('error', 'Not access! You are not this committee member ?');
                        return redirect()->back();
                    }

              
                }elseif($user->role == 4){

                    $committee = $request->committee_id;

                }   
           
           
               
                if(Hash::check($request->password,$user->password))
                {
                   
                    $member_datas['Log_ID']       = $user->id;
                    $member_datas['Log_ROLE']     = $user->role;
                    $member_datas['Log_NAME']     = $user->name;
                    $member_datas['Log_EMAIL']    = $user->email;
                    $member_datas['Log_IMG']      = $user->avatar;
                    $member_datas['Committee_ID'] = $committee;

                    Session::put($member_datas);
                  
                    if($user->role=='2'){
                        return redirect('/app/delegate_dashbord');
                    }elseif($user->role=='3'){
                        return redirect('/app/bureau_dashbord');
                    }elseif($user->role=='4'){
                        return redirect('/app/vipuser_dashbord');
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


