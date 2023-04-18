<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helpers\AdminHelper;
use App\Models\Gallery;
use App\Models\Images;
use App\Models\SiteIndexes;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class LiabilityWaiverController extends Controller
{
  
    public function __construct()
    {
        View::share('routeGroup','liability_form');
    }
    
 

    public function index()
    {
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'liability_waiver')->orderBy('id', 'DESC')->first(); 
        return view('admin/liabilityWaiver/liability_form', compact('data'));
    }

    public function update(Request $request)
    {

        $validatedData = $request->validate([
            'form' => ['required','mimes:pdf,doc', 'max:2055'],
        ],[
            'form.required' => 'The Form field is required',
            'form.max'      => 'Form must be smaller than 2 MB',
            'form.mimes'    => 'Input accept only pdf,doc',
        ]);

        

        $type_data = SiteIndexes::where('type','liability_waiver')->first(); 
        
        if(!empty($type_data)){
            $form = SiteIndexes::where('type','liability_waiver')->first(); 
        }else{
            $form = new SiteIndexes;
        }

        if ($request->hasFile('form')) {
            $doc = $request->file('form');
            $origin_name = $doc ->getClientOriginalName();
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get();
           
            Storage::disk('public')->put('liability_form/'.$docfileName,$file,'public');
           
            $form->name = $origin_name;
            $form->file = 'liability_form/'.$docfileName; 


           $form->save();


         
        if($form->id){
            Session::flash('success', 'Liability form added successfully!');
            return  redirect()->back();
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

        $form = SiteIndexes::where('id', $id)->first(); 
        $mytime  = Carbon::now();
        $timestamp  = $mytime->toDateTimeString();
        $form->deleted_at = $timestamp;
        $form->save();

        echo json_encode(['status'=>true,'message'=>'Liability Form Deleted Successfully !']);exit();
    }
}
