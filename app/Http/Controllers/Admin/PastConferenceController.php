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
use App\Models\Images;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class PastConferenceController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','past_conference');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'past_conference')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/pastConference/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/pastConference/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg','max:2055'],
            'file' => ['required','mimes:pdf','max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'file.required' => 'The File field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'file.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'file.mimes' => 'Input accept only pdf',
        ]);

        $conference = new SiteIndexes;
        $conference->title = $request->title;
        $conference->description  = $request->description;
        $conference->type  = 'past_conference';
        
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(1296, 845, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('pastconference/image/'.$fileName,$img,'public');
           }

           $conference->image = 'pastconference/image/'.$fileName; 


           if ($request->hasFile('file')) {
            $doc = $request->file('file');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get();
            
          
            Storage::disk('public')->put('pastconference/doc/'.$docfileName,$file,'public');
           }

           $conference->file = 'pastconference/doc/'.$docfileName; 


           $conference->save();


        if($conference->id){
            Session::flash('success', 'Past conference added successfully!');
            return redirect('/admin/pastconference_images/'.$conference->id);
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/pastConference/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/pastConference/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
        ]);

    
        $conference = SiteIndexes::where('id', $id)->first(); 
        $conference->title = $request->title;
        $conference->description  = $request->description;
        
       
        
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
                $img->resize(1296, 845, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('pastconference/image/'.$fileName,$img,'public');

            $conference->image = 'pastconference/image/'.$fileName; 
           }

           


           if ($request->hasFile('news_doc')) {

            $validatedData = $request->validate([
                'news_doc' => ['mimes:pdf', 'max:255'],
            ],[
                'news_doc.max' => 'Image  must be smaller than 2 MB',
                'news_doc.mimes' => 'Input accept only pdf',
            ]);
    


            $doc = $request->file('news_doc');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
          
            $extension=$doc->getClientOriginalExtension();
           
            $file = $doc->get();
            
          
            Storage::disk('public')->put('pastconference/doc/'.$docfileName,$file,'public');

            $conference->file = 'pastconference/doc/'.$docfileName; 
           }

           $conference->save();
        
          if($conference->id){
            Session::flash('success', 'Past conference updated successfully!');
            return redirect('/admin/pastconference_images/'.$conference->id);
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }


    public function pastconference_images($id)
    {
        $data = Images::where('connect_id', $id)->where('type', 'past_conference')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(50);
        return view('admin/pastConference/add_images', compact('data','id'));
    }

    public function add_images(Request $request)
    {

        $validatedData = $request->validate([
            'conference_id' => 'required|max:255',
            'image.*' => [
                'required',
                'mimes:jpeg,png,jpg,gif,svg',
                'max:2055',
                function ($attribute, $value, $fail) {
                    if (!$value->isValid()) {
                        $fail($value->getErrorMessage());
                    }
                }
            ]
        ], [
            'conference_id.required' => 'The Title field is required',
            'image.*.required' => 'All image fields are required.',
            'image.*.max' => 'All images must be smaller than 2 MB.',
            'image.*.mimes' => 'Only JPEG, PNG, JPG, GIF, and SVG file types are allowed.',
        ]);
    
       
        $images = $request->file('image');

        
    foreach ($images as $image) {
       
        $fileName = time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
        $extension=$image->getClientOriginalExtension();

        if($extension=='svg'){
            $img = $image->get();
        }else{
            $img = Image::make($image->getRealPath());
            $img->resize(1296, 845, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream('png', 100);
        }
        Storage::disk('public')->put('conference/'.$fileName,$img,'public');

        $conference_item = new Images;
        $conference_item->type = 'past_conference';
        $conference_item->connect_id = $request->conference_id;
        $conference_item->image = 'conference/'.$fileName; 
        $conference_item->save();
    }
        
          if($request->conference_id){
            Session::flash('success', 'Image added successfully!');
            return  redirect()->back();
            }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
       
    }

    
    public function destroy(Request $request,$id)
    {

        $news = SiteIndexes::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Past conference Deleted Successfully !']);exit();
    }

    public function gallery_img_delete(Request $request,$id)
    {

        $gallery = Images::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $gallery->deleted_at = $timestamp;
        $gallery->save();

        echo json_encode(['status'=>true,'message'=>'Image Deleted Successfully !']);exit();
    }
}
