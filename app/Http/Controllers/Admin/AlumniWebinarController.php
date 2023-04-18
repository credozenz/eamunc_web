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
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class AlumniWebinarController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','alumni');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'alumni_webinar')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/alumniwebinar/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/alumniwebinar/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'video' => 'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
        ],[
            'title.required' => 'The Title field is required',
            'video.required' => 'The Video URL field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $alumni_webinar = new SiteIndexes;
        $alumni_webinar->title = $request->title;
        $alumni_webinar->type = 'alumni_webinar';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(345,225, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('alumniwebinar/'.$fileName,$img,'public');
           }

           $alumni_webinar->image = 'alumniwebinar/'.$fileName; 
        
        $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video);


           $alumni_webinar->video = $youtubeurl; 

           $alumni_webinar->save();


        if($alumni_webinar->id){
            Session::flash('success', 'Alumni webinar added successfully!');
            return redirect('/admin/alumniwebinar');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/alumniwebinar/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/alumniwebinar/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'video' => 'required',
        ],[
            'title.required' => 'The Title field is required',
            'video.required' => 'The Video URL field is required',
        ]);
    
        $alumni_webinar = SiteIndexes::where('id', $id)->first(); 
        $alumni_webinar->title = $request->title;
        $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video);
        $alumni_webinar->video = $youtubeurl; 
        if ($request->hasFile('image')) {

            $validatedData = $request->validate([
                'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
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
                $img->resize(345,225, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('alumniwebinar/'.$fileName,$img,'public');

            $alumni_webinar->image = 'alumniwebinar/'.$fileName; 
           }
        $alumni_webinar->save();
        
          if($alumni_webinar->id){
            Session::flash('success', 'Alumni webinar updated successfully!');
            return redirect('/admin/alumniwebinar');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }
    public function archive(Request $request,$id)
    {

        $webinar = SiteIndexes::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $status = $request->input('status');
        $webinar->status = $status;
        $webinar->save();

        echo json_encode(['status'=>true,'message'=>'webinarletter Archive Successfully !']);exit();
    }

    
    public function destroy(Request $request,$id)
    {

        $webinar = SiteIndexes::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $webinar->deleted_at = $timestamp;
        $webinar->save();

        echo json_encode(['status'=>true,'message'=>'Alumni webinar Deleted Successfully !']);exit();
    }
}
