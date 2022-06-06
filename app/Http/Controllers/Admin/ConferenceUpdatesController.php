<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class ConferenceUpdatesController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','home');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'conference_update')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/conferenceUpdates/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/conferenceUpdates/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg','max:2050'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $conference = new SiteIndexes;
        $conference->title = $request->title;
        $conference->description = $request->description;
        $conference->type = 'conference_update';
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(345, 225, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('conference_updates/'.$fileName,$img,'public');
           }

           $conference->image = 'conference_updates/'.$fileName; 

           $conference->save();


        if($conference->id){
            Session::flash('success', 'Conference updates added successfully!');
            return redirect('/admin/conference_updates');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/conferenceUpdates/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/conferenceUpdates/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
        ]);

    
        $conference = SiteIndexes::where('id', $id)->first(); 
        $conference->title = $request->title;
        $conference->description = $request->description;
        
        if ($request->hasFile('image')) {

            $validatedData = $request->validate([
                'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2050'],
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
                $img->resize(345, 225, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('conference_updates/'.$fileName,$img,'public');

            $conference->image = 'conference_updates/'.$fileName; 
           }

         
           $conference->save();
        
          if($conference->id){
            Session::flash('success', 'Conference updates updated successfully!');
            return redirect('/admin/conference_updates');
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

        echo json_encode(['status'=>true,'message'=>'Conference updates Deleted Successfully !']);exit();
    }
}
