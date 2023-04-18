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
use App\Models\SiteIndexes;
use App\Models\CertificateSetup;
use App\Models\Certificate;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class CertificateController extends Controller
{
  
    public function __construct()
    {
        View::share('routeGroup','certificate');
    }
    
    public function index(Request $request)
    {

        $data = CertificateSetup::where('deleted_at', null)->orderBy('id', 'ASC')->paginate(10);
        $certi = Certificate::where('id',1)->first();
        return view('admin/certificate/index', compact('data','certi'));
       
    }


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'type' => 'required|max:255',
            'name' => ['required'],
        ],[
            'type.required' => 'The Type field is required',
            'name.required' => 'The Name field is required',
        ]);


        $setup = new CertificateSetup;
        $setup->index_type = $request->type;
            $inputValue = $request->name;
            $inputValue = strtolower($inputValue);
            $inputValue = str_replace(' ', '_', $inputValue);
            $inputValue = '%'.$inputValue.'%' ;
        $setup->index_name = $inputValue;

        if ($request->hasFile('image')) {

            $validatedData = $request->validate([
                'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2055']
            ],[
                
                 'image.max' => 'Image  must be smaller than 2 MB',
                 'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            ]);

            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(1080, 480, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('certi_setup/'.$fileName,$img,'public');

            $setup->index_value = url('/uploads/certi_setup/'.$fileName); 
           }else{

            $setup->index_value = $request->value;

           }

           $setup->save();


           if($setup->id){
            Session::flash('success', 'Set up added successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

       
    }


    public function destroy(Request $request,$id)
    {

        $setup = CertificateSetup::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $setup->deleted_at = $timestamp;
        $setup->save();

        echo json_encode(['status'=>true,'message'=>'Set up Deleted Successfully !']);exit();
    }


    public function show(Request $request)
    {
        $setup = CertificateSetup::where('deleted_at', null)->orderBy('id', 'ASC')->get();
        
        $data = Certificate::where('id',1)->first();
        $html = $data->certi_design;

        $setup = CertificateSetup::where('deleted_at', null)->orderBy('id', 'ASC')->get();

        if(!empty($setup)){
            foreach ($setup as $each){
                    $html =str_replace($each->index_name, $each->index_value, $html);
            }
        }
        
        return view('admin/certificate/show', compact('html','setup'));
       
    }
   
    
    public function update(Request $request,$id)
    {
        
        $certi = Certificate::where('id', $id)->first();
        $certi->certi_name = 'CERTIFICATE OF PARTICIPATION';
        $certi->certi_design = $request->certificate_design;
        $certi->save(); 
        if($certi->id){
            Session::flash('success', 'Certificate Updated successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
    }

    
   
}
