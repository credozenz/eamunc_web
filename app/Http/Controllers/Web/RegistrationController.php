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
use App\Models\Students;
use App\Models\Countries;
use App\Models\User;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class RegistrationController extends Controller
{
    public function index()
    {
       
        $reg_status = SiteIndexes::where('type','reg_status')->first();
        return view('web/registration', compact('reg_status'));
    }

   
    public function isg_registration()
    {
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50); 

        $countries = Countries::all();
        $reg_status = SiteIndexes::where('type','reg_status')->first();
        return view('web/isg-registration', compact('committees','countries','reg_status'));
    }


    public function isg_store(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'class' => 'required|max:255',
            'committee_choice' => 'required|max:255',
            'country_choice' => 'required|max:255',
            'phone_code'    => 'required|max:255',
            'whatsapp_no'    => 'required|max:255',
            'mun_experience' => 'required|max:255',
            "bureaumem_experience"    => "required|max:255",
        ],[
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email Number',
            'email.unique' => 'Email id already exists',
            'class.required' => 'The Class field is required',
            'committee_choice.required' => 'The Committee choice field is required',
            'country_choice.required' => 'The Country choice field is required',
            'whatsapp_no.required' => 'The WhatsApp No field is required',
            'phone_code.required' => 'The Phone code field is required',
            'mun_experience.required' => 'The MUN Experience field is required',
            'bureaumem_experience.required' => 'The Bureaumem Experience field is required',
        ]);


       $phone_code = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $request->phone_code);
       
            $user = new User;
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->phone = $request->whatsapp_no;
            $user->role = 2;
            $user->type = 1;
            $user->save();
           
            if($user->id){

            $student = new Students;
            $student->type  = 1;
            $student->school_id  = 1;
            $student->name  = $request->name;
            $student->email = $request->email;
            $student->class = $request->class;
            $student->committee_choice = $request->committee_choice;
            $student->country_choice   = $request->country_choice;
            $student->phone_code     = $phone_code;
            $student->whatsapp_no    = $request->whatsapp_no;
            $student->mun_experience = $request->mun_experience;
            $student->bureaumem_experience = $request->bureaumem_experience;
            $student->user_id = $user->id;
            $student->save();
            
            if($student->id){
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
        $countries = Countries::all();
        $reg_status = SiteIndexes::where('type','reg_status')->first();
        return view('web/school-registration', compact('committees','countries','reg_status'));
    }


    public function school_store(Request $request)
    {
       
        $validatedData = $request->validate([
            'school_name' => 'required|max:255',
            'advisor_name' => 'required|max:255',
            'advisor_email' => 'required|max:255',
            'advisor_mobile' => 'required|max:255',
            'mob_code' => 'required|max:255',
            "name"    => "required|array",
            "name.*"  => "required",
            "email"    => "required|array",
            'email.*' => 'required|max:255|email',
            "class"    => "required|array",
            "class.*"  => "required|string",
            'phone_code'    => 'required|max:255',
            "whatsapp_no"    => "required|array",
            "whatsapp_no.*"  => "required",
            "mun_experience"    => "required|array",
            "mun_experience.*"  => "required",
            "bureaumem_experience"    => "required|array",
            "bureaumem_experience.*"  => "required",
            'school_logo' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
        ],[
            'school_name.required' => 'The School Name field is required',
            'advisor_name.required' => 'The Advisor Name field is required',
            'advisor_email.required' => 'The Advisor Email field is required',
            'advisor_mobile.required' => 'The Advisor Mobile field is required',
            'mob_code.required' => 'The Phone code field is required',
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email Number',
            'email.unique' => 'Email id already exists',
            'class.required' => 'The Class field is required',
            'phone_code.required' => 'The Phone code field is required',
            'whatsapp_no.required' => 'The WhatsApp No field is required',
            'mun_experience.required' => 'The MUN Experience field is required',
            'school_logo.max' => 'Logo  must be smaller than 2 MB',
            'school_logo.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);
      
        $phone_code = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $request->mob_code);

            $school = new School;
            $school->name   = $request->school_name;
            $school->email  = $request->advisor_email;
            $school->mobile = $phone_code.$request->advisor_mobile;
            $school->advisor_name = $request->advisor_name;
            

                if ($request->hasFile('school_logo')) {
                $image = $request->file('school_logo');
                $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
              
                $extension=$image->getClientOriginalExtension();
               
                if($extension=='svg'){
                   $img = $image->get();
                }else{
                    $img = Image::make($image->getRealPath());
                    $img->resize(220, 280, function ($constraint) {
                       $constraint->aspectRatio();                 
                    });
                    $img->stream('png', 100);
                }
                
                Storage::disk('public')->put('host_schools/'.$fileName,$img,'public');
               }
    
            $school->logo = 'host_schools/'.$fileName; 

            $school->save();

        if($school->id){

        $name = $request->input('name');
        $email = $request->input('email');
        $class = $request->input('class');
        $phone_code = $request->input('phone_code');
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
            $user->phone = $whatsapp_no[$count];
            $user->role = 2;
            $user->type = 2;
            $user->save();
        
             $student = new Students;
             $student->type  = 2;
             $student->name  = $name[$count];
             $student->email  = $email[$count];
             $student->user_id    = $user->id;
             $student->school_id  = $school->id;
             $student->class  = $class[$count];
             $student->phone_code     = $phone_code[$count];
             $student->whatsapp_no = $whatsapp_no[$count];
             $student->mun_experience = $mun_experience[$count];
             $student->bureaumem_experience = $bureaumem_experience[$count];
             $student->save();
            }

          }
          
            if($student->id){
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



    public function validate_user_email(Request $request)
    {
       
        $user = User::where('email', $request->email); 
      
        if(empty($user->count())){
              echo json_encode(['status'=>true]);exit();
        }else{
             echo json_encode(['status'=>false]);exit();
        }
    }

    public function validate_user_phone(Request $request)
    {
       
        $user = User::where('phone', $request->phone); 
      
        if(empty($user->count())){
              echo json_encode(['status'=>true]);exit();
        }else{
             echo json_encode(['status'=>false]);exit();
        }
    }




}
