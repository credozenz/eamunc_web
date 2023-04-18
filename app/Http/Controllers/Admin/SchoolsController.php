<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Dompdf\Dompdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer as Writer;
use View;
use App\Helpers\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class SchoolsController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','school');
    }
  
    public function index(Request $request)
    {   
       
        $myschool = School::where('id', 1)->first();
        $query = School::where('deleted_at', null)
        ->where('id','!=', 1)
        ->orderBy('id', 'DESC');
        if($request->q){
            $query->where('name','LIKE', $request->q);
        }
        
        $data=$query->paginate(10); 

        
        return view('admin/schools/index', compact('data','myschool','request'));
    }

    
    
    public function show($id)
    {
        $data = School::find($id); 
        
        return view('admin/schools/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = School::find($id); 
        
        return view('admin/schools/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'school_name' => 'required|max:255',
            'advisor_name' => 'required|max:255',
            'advisor_email' => 'required|max:255',
            'advisor_mobile' => 'required|max:255',
            'school_logo' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
        ],[
            'school_name.required' => 'The School Name field is required',
            'advisor_name.required' => 'The Advisor Name field is required',
            'advisor_email.required' => 'The Advisor Email field is required',
            'advisor_mobile.required' => 'The Advisor Mobile field is required',
            'school_logo.max' => 'Logo  must be smaller than 2 MB',
            'school_logo.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);
      

            $school = School::where('id', $id)->first(); 
            $school->name   = $request->school_name;
            $school->email  = $request->advisor_email;
            $school->mobile = $request->advisor_mobile;
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
                $school->logo = 'host_schools/'.$fileName; 
               }
    
           

            $school->save();
    
       
        
          if($school->id){
            Session::flash('success', 'School updated successfully!');
            return redirect('/admin/schools');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }

    
    public function destroy(Request $request,$id)
    {

        $school = School::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $school->deleted_at = $timestamp;
        $school->save();

        echo json_encode(['status'=>true,'message'=>'School Deleted Successfully !']);exit();
    }


    public function faculty_advisors(Request $request)
    {   
        View::share('routeGroup','faculty_advisors');
        $myschool = School::where('id', 1)->first();
        $query = School::where('deleted_at', null)
        ->where('id','!=', 1)
        ->orderBy('id', 'DESC');
        if($request->q){
            $query->where('name','LIKE', $request->q);
        }
        
        $data=$query->paginate(10); 

        return view('admin/schools/faculty_advisor', compact('data','myschool','request'));
    }

   

}
