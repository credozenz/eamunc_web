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

class DelegateController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','delegates');
    }
    
    public function isg_delegates(Request $request)
    {
        $data = Isg_delegates::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
       
        return view('admin/delegates/isg_delegate', compact('data'));
       
    }

    public function isg_delegates_show(Request $request,$id)
    {
       
        $data = Isg_delegates::where('id', $id)->where('deleted_at', null)->first();   
        
        return view('admin/delegates/isg_delegate_show', compact('data'));
       
    }

    public function isg_delegates_edit(Request $request,$id)
    {
       
        $data = Isg_delegates::where('id', $id)->where('deleted_at', null)->first();  
        $committees = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/delegates/isg_delegate_edit', compact('data','committees'));
       
    }


    public function isg_delegates_update(Request $request,$id)
    {
        $delegate = Isg_delegates::where('id', $id)->first();
        
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

    
    public function isg_delegates_destroy(Request $request,$id)
    {

        $delegate = Isg_delegates::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $delegate->deleted_at = $timestamp;
        $delegate->save();

        echo json_encode(['status'=>true,'message'=>'Delegate Deleted Successfully !']);exit();
    }



    public function school_delegates(Request $request)
    {
       
        $data = School_Delegates::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        
        return view('admin/delegates/delegate', compact('data'));
       
    }

    public function school_delegates_edit(Request $request)
    {
       
        $data = School_Delegates::where('deleted_at', null)->first();  
        
        return view('admin/delegates/delegate_edit', compact('data'));
       
    }

    public function school_delegates_show(Request $request)
    {
       
        $data = School_Delegates::where('deleted_at', null)->first();  
        
        return view('admin/delegates/delegate_show', compact('data'));
       
    }

}
