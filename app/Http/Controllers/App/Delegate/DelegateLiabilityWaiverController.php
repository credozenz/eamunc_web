<?php
namespace App\Http\Controllers\App\Delegate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\WebAppHelper;
use App\Models\Gallery;
use App\Models\Images;
use App\Models\SiteIndexes;
use App\Models\Students;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class DelegateLiabilityWaiverController extends Controller
{
  
    public function __construct()
    {
        View::share('routeGroup','delegate_dashbord');
    }
    
 

    public function index()
    {
        $member = WebAppHelper::getLogMember();

        $data = SiteIndexes::where('deleted_at', null)->where('type', 'liability_waiver')->orderBy('id', 'DESC')->first(); 
       
        $student = Students::where('user_id',$member->user_id)->first();
       
        return view('app/delegate/liability_form', compact('data','student'));
    }

    public function store(Request $request)
    {

        $member = WebAppHelper::getLogMember();

        $validatedData = $request->validate([
            'form' => ['required','mimes:pdf,doc', 'max:2055'],
        ],[
            'form.required' => 'The Form field is required',
            'form.max'      => 'Form  must be smaller than 2 MB',
            'form.mimes'    => 'Input accept only pdf,doc',
        ]);

        $form = Students::where('user_id',$member->user_id)->first();

        if ($request->hasFile('form')) {

            $doc = $request->file('form');

            $origin_name = $doc ->getClientOriginalName();
           
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
          
            $extension  =  $doc->getClientOriginalExtension();
           
           
           
            Storage::disk('public')->put('liability_submitform/'.$fileName,$doc,'public');

       
           $form->liability_form = 'liability_submitform/'.$fileName; 

           $form->save();

         
        if($form->id){
            Session::flash('success', 'Liability form Submitted successfully!');
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
