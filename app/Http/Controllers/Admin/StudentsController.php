<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Students;
use App\Models\Countries;
use App\Models\Committee;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

use Str;
use Mail;
use Image;
use Storage;
use League\Flysystem\File;

class StudentsController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','students');
    }
    
 
    public function index(Request $request)
    {

        $data = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '!=' , 1)
        ->orderBy('students.id', 'desc')
        ->paginate(4);

       
        return view('admin/students/index', compact('data'));
       
    }

    public function edit(Request $request,$id)
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50); 
        $data = students::where('id', $id)->first();  
        $school = School::where('id', $data->school_id)->first(); 
        $user = User::where('id', $data->user_id)->first(); 
        $countries = Countries::all();
        return view('admin/students/edit', compact('data','school','committees','user','countries'));
       
    }

    public function show(Request $request,$id)
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50);
        $data = students::where('id', $id)->first();  
        $school = School::where('id', $data->school_id)->first(); 
        $user = User::where('id', $data->user_id)->first(); 
        $countries = Countries::all();
        return view('admin/students/show', compact('data','school','user','committees','id','countries'));
       
    }


    public function update(Request $request,$id)
    {

        
        $student = students::where('id', $id)->first();
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($student->user_id, 'id'),
            ],
            'class' => 'required|max:255',
            'committee_choice' => 'required|max:255',
            'country_choice' => 'required|max:255',
            'phone_code'    => 'required|max:255',
            'whatsapp_no'    => 'required|max:255',
            'mun_experience' => 'required|max:255',
        ],[
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email Number',
            'email.unique' => 'Email id already exists',
            'class.required' => 'The Class field is required',
            'committee_choice.required' => 'The Committee choice field is required',
            'country_choice.required' => 'The Country choice field is required',
            'phone_code.required' => 'The Phone code field is required',
            'whatsapp_no.required' => 'The WhatsApp No field is required',
            'mun_experience.required' => 'The MUN Experience field is required',
        ]);


        $phone_code = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $request->phone_code);
        $position = NULL;

        if($request->role == '3'){

            $validatedData = $request->validate([
                'position' => 'required|max:255',
            ],[
                'position.required' => 'The position field is required',
            ]);

            $position = $request->position;

        }
        
            $user = User::where('id', $student->user_id)->first();
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->role = $request->role;
            $user->save();
           
            if($user->id){

            $student = students::where('id', $id)->first();
            $student->name  = $request->name;
            $student->email = $request->email;
            $student->class = $request->class;
            $student->committee_choice = $request->committee_choice;
            $student->country_choice   = $request->country_choice;
            $student->phone_code    = $phone_code;
            $student->whatsapp_no    = $request->whatsapp_no;
            $student->mun_experience = $request->mun_experience;
            $student->user_id  = $user->id;
            $student->position = $position;
            if($request->status != null){
                $student->status   = $request->status;
            }
            
            $student->save();
            
            if($student->id){
                Session::flash('success', 'Student Updated successfully Completed!');
                return redirect('admin/students');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    
    }


    public function destroy(Request $request,$id)
    {
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();

        $student = students::where('id', $id)->first(); 
        $student->deleted_at = $timestamp;
        $student->save();

        $user = User::where('id', $student->user_id)->first(); 
        $user->deleted_at = $timestamp;
        $user->save();

        echo json_encode(['status'=>true,'message'=>'Student Deleted Successfully !']);exit();
    }



    public function status_change(Request $request,$id)
    {
        
        
        $validatedData = $request->validate([
            'status' => 'required',
            'role' => 'required',
        ],[
            'status.required' => 'The status field is required',
            'role.required' => 'The role field is required',
        ]);


        
            $student = students::where('user_id', $id)->first();
            $student->status  = $request->status;
            $student->save();

            $user = User::where('id', $id)->first();
            $user->role  = $request->role;
            $user->save(); 

          
            if($student){
                Session::flash('success', 'Student status successfully Completed!');
                return redirect('admin/students');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
       
    
    }



    public function invite_student(Request $request,$id)
    {
        
        
            $student = students::where('id', $id)->first();
            

                if($student){

                    $token = Str::random(64);
               $settoken = DB::table('password_resets')->insert([
                            'email' => $student->email,
                            'token' => $token,
                            'created_at' => Carbon::now()
                        ]);
                    
                if($settoken) {
                    Mail::send('admin.auth.forget-password-email', ['token' => $token], function($message) use($student){
                        $message->to(trim($student->email));
                        $message->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'));
                        $message->subject('Reset Password');
                    });


                    $student->status  = 2;
                    $student->save();

                    
                  } 
                }
           
                
            if($student){
                Session::flash('success', 'Student invited successfully Completed!');
                return  redirect()->back();
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }


    }
       
    
    








}
