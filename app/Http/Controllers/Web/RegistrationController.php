<?php

namespace App\Http\Controllers\Web;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Committee;
use App\Models\School;
use App\Models\School_Delegates;
use App\Models\Registration_isg;
use App\Models\User;

class RegistrationController extends Controller
{
    public function index()
    {
        $data ='';

        return view('web/registration', compact('data'));
    }

   
    public function isg_registration()
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 

        return view('web/isg-registration', compact('committees'));
    }


    public function isg_store(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'class' => 'required|max:255',
            'committee_choice' => 'required|max:255',
            'country_choice' => 'required|max:255',
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
            'whatsapp_no.required' => 'The WhatsApp No field is required',
            'mun_experience.required' => 'The MUN Experience field is required',
        ]);

        
            $user = new User;
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->role = 3;
            $user->save();
           
            if($user->id){

            $registration = new Registration_isg;
            $registration->name  = $request->name;
            $registration->email = $request->email;
            $registration->class = $request->class;
            $registration->committee_choice = $request->committee_choice;
            $registration->country_choice   = $request->country_choice;
            $registration->whatsapp_no    = $request->whatsapp_no;
            $registration->mun_experience = $request->mun_experience;
            $registration->user_id = $user->id;
            $registration->save();
            
            if($registration->id){
                Session::flash('success', 'Registration successfully Completed!');
                return redirect('isg-registration');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    
    }


    public function school_registration()
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 

        return view('web/school-registration', compact('committees'));
    }


    public function school_store(Request $request)
    {

        $validatedData = $request->validate([
            'school_name' => 'required|max:255',
            'advisor_name' => 'required|max:255',
            'advisor_email' => 'required|max:255',
            'advisor_mobile' => 'required|max:255',
            "name"    => "required|array",
            "name.*"  => "required",
            "email"    => "required|array",
            'email.*' => 'required|max:255|email',
            "class"    => "required|array",
            "class.*"  => "required|string",
            "whatsapp_no"    => "required|array",
            "whatsapp_no.*"  => "required",
            "mun_experience"    => "required|array",
            "mun_experience.*"  => "required",
            "bureaumem_experience"    => "required|array",
            "bureaumem_experience.*"  => "required",
        ],[
            'school_name.required' => 'The School Name field is required',
            'advisor_name.required' => 'The Advisor Name field is required',
            'advisor_email.required' => 'The Advisor Email field is required',
            'advisor_mobile.required' => 'The Advisor Mobile field is required',
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email Number',
            'email.unique' => 'Email id already exists',
            'class.required' => 'The Class field is required',
            'whatsapp_no.required' => 'The WhatsApp No field is required',
            'mun_experience.required' => 'The MUN Experience field is required',
        ]);
      

            $school = new School;
            $school->name   = $request->school_name;
            $school->email  = $request->advisor_email;
            $school->mobile = $request->advisor_mobile;
            $school->advisor_name = $request->advisor_name;
            $school->save();

            if($school->id){

        $name = $request->input('name');
        $email = $request->input('email');
        $class = $request->input('class');
        $whatsapp_no = $request->input('whatsapp_no');
        $mun_experience = $request->input('mun_experience');
        $bureaumem_experience = $request->input('bureaumem_experience');

        

        for($count = 0; $count < count($name); $count++)
        {
            $user = User::where('email', $email[$count]); 
      
          if(empty($user->count())){

            $user = new User;
            $user->name  = $name[$count];
            $user->email = $email[$count];
            $user->role = 3;
            $user->save();
        
             $delegate = new School_Delegates;
             $delegate->name  = $name[$count];
             $delegate->email  = $email[$count];
             $delegate->user_id    = $user->id;
             $delegate->school_id  = $school->id;
             $delegate->class  = $class[$count];
             $delegate->whatsapp_no = $whatsapp_no[$count];
             $delegate->mun_experience = $mun_experience[$count];
             $delegate->bureaumem_experience = $bureaumem_experience[$count];
             $delegate->save();
            }

          }
          
            if($delegate->id){
                Session::flash('success', 'Registration successfully Completed!');
                return redirect('school-registration');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }

   
    
    }



    public function validate_user_email(Request $request,$id)
    {

        $news = $request; 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Agent Deleted Successfully !']);exit();
    }

}
