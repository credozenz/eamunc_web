<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\WebHelper;
use App\Models\SiteIndexes;
use App\Models\Alumni_registration;

class AlumniController extends Controller
{

    public function alumni_news_inner($id)
    {
        

         $alumni_news = SiteIndexes::where('id', $id)->where('type', 'alumni_news')->where('status', '1')->first(); 
        
        return view('web/alumni-news', compact('alumni_news'));


    }
  
    public function index()
    {
        
        $webinar = SiteIndexes::where('deleted_at', null)->where('type', 'alumni_webinar')->orderBy('id', 'DESC')->paginate(9); 
      
        $alumni = SiteIndexes::where('deleted_at', null)->where('type','alumni')->first(); 
        $alumni_news = SiteIndexes::where('deleted_at', null)->where('type', 'alumni_news')->where('status', '1')->orderBy('id', 'DESC')->paginate(4); 
        return view('web/alumni', compact('alumni','alumni_news','webinar'));


    }


    public function registration()
    {
        
       return view('web/alumni-registration');


    }

    public function registration_store(Request $request)
    {
       
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255|email|unique:users,email',
            'qualification' => 'required|max:255',
            'dob' => 'required|max:255',
            'portfolio' => 'required|max:255',
            // 'phone_code'    => 'required|max:255',
            // 'phone_no'    => 'required|max:255',
        ],[
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email Number',
            'email.unique' => 'Email id already exists',
            'qualification.required' => 'The Qualification field is required',
            'dob.required' => 'The DOB field is required',
            'portfolio.required' => 'The Portfolio field is required',
            // 'phone_no.required' => 'The Phone No field is required',
            // 'phone_code.required' => 'The Phone code field is required',
        ]);


            $alumni = new Alumni_registration;
            $alumni->name  = $request->name;
            $alumni->email = $request->email;
            $alumni->phone_code = $request->phone_code;
            $alumni->phone_no   = $request->phone_no;
            $alumni->qualification = $request->qualification;
            $alumni->dob = $request->dob;
            $alumni->portfolio   = $request->portfolio;
            $alumni->save();
            
            if($alumni->id){
                Session::flash('success', 'Registration successfully Completed!');
                return redirect('alumni-registration');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        }
    

}
