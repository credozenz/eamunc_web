<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\Faculties_messages;

use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class FacultiesMessagesController extends Controller
{
  
    public function index(Request $request)
    {   
        $data = Faculties_messages::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/facultiesMessage/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/facultiesMessage/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'post' => 'required|max:255',
            'thumbnail' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            'video_url' => ['required', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'name.required' => 'The Name field is required',
            'post.required' => 'The Post field is required',
            'thumbnail.required' => 'The Thumbnail field is required',
            'video_url.required' => 'The video url field is required',
            'thumbnail.max' => 'Image  must be smaller than 2 MB',
        ]);

        $message = new Faculties_messages;
        $message->title = $request->title;
        $message->name  = $request->name;
        $message->post  = $request->post;
        
        
        
        if ($request->hasFile('thumbnail')) {
            $image = $request->file('thumbnail');
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
            
            Storage::disk('public')->put('thumbnail/'.$fileName,$img,'public');
           }

           $message->thumbnail = 'thumbnail/'.$fileName; 

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video_url);
          
           $message->video_url  = $youtubeurl;

           $message->save();


        if($message->id){
            Session::flash('success', 'Faculties Message added successfully!');
            return redirect('/admin/facultiesmessages');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = Faculties_messages::find($id); 
        
        return view('admin/facultiesMessage/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = Faculties_messages::find($id); 
        
        return view('admin/facultiesMessage/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'post' => 'required|max:255',
            'video_url' => ['required', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'name.required' => 'The Name field is required',
            'post.required' => 'The Post field is required',
            'video_url.required' => 'The video url field is required',
            'thumbnail.max' => 'Image  must be smaller than 2 MB',
        ]);

    
        $message = Faculties_messages::where('id', $id)->first(); 
        $message->title = $request->title;
        $message->name  = $request->name;
        $message->post  = $request->post;
        
        if ($request->hasFile('thumbnail')) {


            $validatedData = $request->validate([
                'thumbnail' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            ],[
                'thumbnail.required' => 'The Thumbnail field is required',
                'thumbnail.max' => 'Image  must be smaller than 2 MB',
            ]);


            $image = $request->file('thumbnail');
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
            
            Storage::disk('public')->put('thumbnail/'.$fileName,$img,'public');
            $message->thumbnail = 'thumbnail/'.$fileName; 
           }

           

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video_url);
          
           $message->video_url  = $youtubeurl;

           $message->save();

        
          if($message->id){
            Session::flash('success', 'Faculties message updated successfully!');
            return redirect('/admin/facultiesmessages');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
         
                     
    }
          
    
    public function destroy(Request $request,$id)
    {

        $news = Faculties_messages::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Faculties message Deleted Successfully !']);exit();
    }
}