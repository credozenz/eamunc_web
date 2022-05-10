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
use App\Models\School_Delegates;
use App\Models\Isg_delegates;
use App\Models\Committee;
use App\Models\User;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class MembersController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','members');
    }
    
    public function members(Request $request)
    {
        $data = User::where('deleted_at', null)->where('deleted_at', null)->where('role', '!=' , 1)->orderBy('id', 'DESC')->paginate(5); 
       
        return view('admin/members/index', compact('data'));
       
    }

    public function members_show(Request $request,$id)
    {
       
       $user = User::where('id', $id)->where('deleted_at', null)->first();   
       $type = $user->type;
        if($type == '1'){
            $data = School_Delegates::where('user_id', $user->id)->first();  
            $school = School::where('id', $data->school_id)->first(); 
        }elseif($type == '0'){
            $data = Isg_delegates::where('user_id', $user->id)->where('deleted_at', null)->first();
            $school =''; 
        }
        
        
        return view('admin/members/show', compact('data','type','school','user','id'));
       
    }

    public function members_edit(Request $request,$id)
    {
       
        $data = User::where('id', $id)->where('deleted_at', null)->first();  
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/members/edit', compact('data','committees'));
       
    }


    public function members_update(Request $request,$id)
    {
        $delegate = User::where('id', $id)->first();
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => [
                'required',
                Rule::unique('users')->ignore($delegate->user_id, 'id'),
            ],
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


        
        
            $user = User::where('id', $delegate->user_id)->first();
            $user->name  = $request->name;
            $user->email = $request->email;
            $user->role = 3;
            $user->save();
           
            if($user->id){

            $registration = Isg_delegates::where('id', $id)->first();
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
                Session::flash('success', 'Updated successfully Completed!');
                return redirect('admin/isg_delegates');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    
    }

    
    public function members_destroy(Request $request,$id)
    {

        $delegate = User::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $delegate->deleted_at = $timestamp;
        $delegate->save();

        echo json_encode(['status'=>true,'message'=>'Delegate Deleted Successfully !']);exit();
    }


    public function member_rolechange(Request $request,$id)
    {
        
        $user = User::where('id', $id)->first(); 
        $user->role = $request->status;
        $user->save();

        if($user){
            echo json_encode(['status'=>true,'message'=>'Member role changed Successfully !']);exit();
        }else{
            echo json_encode(['status'=>false,'message'=>'Something went wrong please try again !']);exit();
        }
        
        
    }



    
}
