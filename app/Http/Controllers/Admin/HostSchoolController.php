<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\Host_schools;

use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class HostSchoolController extends Controller
{
  
    public function index(Request $request)
    {   
        $data = Host_schools::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/hostSchools/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/hostSchools/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
        ],[
            'name.required' => 'The Name field is required',
            'description.required' => 'The Description field is required',
            'title.required' => 'The Title field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $host = new Host_schools;
        $host->title = $request->title;
        $host->name = $request->name;
        $host->description = $request->description;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(100, 100, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('host_schools/'.$fileName,$img,'public');
           }

           $host->image = 'host_schools/'.$fileName; 

           $host->save();


        if($host->id){
            Session::flash('success', 'Host schools added successfully!');
            return redirect('/admin/host_schools');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = Host_schools::find($id); 
        
        return view('admin/hostSchools/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = Host_schools::find($id); 
        
        return view('admin/hostSchools/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
        ]);

    
        $host = Host_schools::where('id', $id)->first(); 
        $host->title = $request->title;
        $host->name = $request->name;
        $host->description  = $request->description;
        
        if ($request->hasFile('image')) {

            $validatedData = $request->validate([
                'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255'],
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
                $img->resize(100, 100, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('host_schools/'.$fileName,$img,'public');

            $host->image = 'host_schools/'.$fileName; 
           }

         
           $host->save();
        
          if($host->id){
            Session::flash('success', 'Host schools updated successfully!');
            return redirect('/admin/host_schools');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }

    
    public function destroy(Request $request,$id)
    {

        $news = Host_schools::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Host schools Deleted Successfully !']);exit();
    }
}
