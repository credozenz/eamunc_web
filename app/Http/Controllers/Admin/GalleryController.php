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

class GalleryController extends Controller
{
  
    public function __construct()
    {
        View::share('routeGroup','gallery');
    }
    
    public function index(Request $request)
    {   
        $data = Gallery::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
       
        return view('admin/gallery/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/gallery/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'cover_image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'cover_image.required' => 'The Image field is required',
            'cover_image.max' => 'Image  must be smaller than 2 MB',
            'cover_image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $gallery = new Gallery;
        $gallery->name = $request->title;
        $gallery->status = 0;
        if ($request->hasFile('cover_image')) {
            $image = $request->file('cover_image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(306,288, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('gallery/'.$fileName,$img,'public');
           }

           $gallery->cover_image = 'gallery/'.$fileName; 

           $gallery->save();


        if($gallery->id){
            Session::flash('success', 'Gallery added successfully!');
            return redirect('/admin/gallery_images/'.$gallery->id);
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

    public function gallery_images($id)
    {
        $data = Images::where('connect_id', $id)->where('type', 'gallery')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(12);
        return view('admin/gallery/add_images', compact('data','id'));
    }


public function add_images(Request $request)
{

    
    $validatedData = $request->validate([
        'gallery_id' => 'required|max:255',
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
        'gallery_id.required' => 'The Title field is required',
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
            $img->resize(532,300, function ($constraint) {
                $constraint->aspectRatio();
            });
            $img->stream('png', 100);
        }
        Storage::disk('public')->put('gallery/'.$fileName,$img,'public');

        $gallery_item = new Images;
        $gallery_item->type = 'gallery';
        $gallery_item->connect_id = $request->gallery_id;
        $gallery_item->image = 'gallery/'.$fileName; 
        $gallery_item->save();
    }

    $data = Gallery::where('id', $request->gallery_id)->first(); 
    $data->status = 1;
    $data->save();

    if($data){
        Session::flash('success', 'Image added successfully!');
        return  redirect()->back();
      }else{
        Session::flash('error', 'Something went wrong!!');
        return  redirect()->back();
      }
}


    

    public function add_video(Request $request)
    {

        $validatedData = $request->validate([
            'gallery_id' => 'required|max:255',
            'video' => ['required'],
        ],[
            'gallery_id.required' => 'The Title field is required',
            'video.required' => 'The video field is required',
        ]);
        $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video);

        $gallery = new Images;
        $gallery->type = 'gallery';
        $gallery->connect_id = $request->gallery_id;
        $gallery->video = $youtubeurl;
        $gallery->save();

           $data = Gallery::where('id', $request->gallery_id)->first(); 
           $data->status = 1;
           $data->save();

        if($gallery->id){
            Session::flash('success', 'Video added successfully!');
            return  redirect()->back();
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
       
    }
    
    public function show($id)
    {
        $gallery = Gallery::find($id); 
        $images = Images::where('connect_id', $id)->where('type', 'gallery')->where('deleted_at', null)->orderBy('id', 'DESC')->paginate(12);
        return view('admin/gallery/show', compact('gallery','images','id'));
    }

   
    public function edit($id)
    {
        $data = Gallery::find($id); 
        
        return view('admin/gallery/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
        ],[
            'title.required' => 'The Title field is required',
        ]);

    
        $gallery = Gallery::where('id', $id)->first(); 
        $gallery->name = $request->title;
       
        
        if ($request->hasFile('cover_image')) {

            $validatedData = $request->validate([
                'cover_image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            ],[
                'cover_image.max' => 'Image  must be smaller than 2 MB',
                'cover_image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            ]);
    



            $image = $request->file('cover_image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(306,288, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('gallery/'.$fileName,$img,'public');

            $gallery->cover_image = 'gallery/'.$fileName; 
           }

         
           $gallery->save();
        
          if($gallery->id){
            Session::flash('success', 'Gallery updated successfully!');
            return redirect('/admin/gallery_images/'.$gallery->id);
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }

    public function gallery_img_delete(Request $request,$id)
    {

        $gallery = Images::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $gallery->deleted_at = $timestamp;
        $gallery->save();

        echo json_encode(['status'=>true,'message'=>'Gallery Image Deleted Successfully !']);exit();
    }
    
    public function destroy(Request $request,$id)
    {

        $gallery = Gallery::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $gallery->deleted_at = $timestamp;
        $gallery->save();

        echo json_encode(['status'=>true,'message'=>'Gallery Deleted Successfully !']);exit();
    }
}
