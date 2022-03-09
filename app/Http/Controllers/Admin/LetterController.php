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

class LetterController extends Controller
{

    public function __construct()
    {
        // $currentPath= Route::currentRouteName();
        // View::share('currentPath',$currentPath);
    }
  
    public function index(Request $request)
    {   

        $data = SiteIndexes::where('deleted_at', null)->where('type', 'letter')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/letters/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/letters/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'post' => 'required|max:255',
            'description' => 'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'post.required' => 'The Post field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $letter = new SiteIndexes;
        $letter->title = $request->title;
        $letter->name = $request->name;
        $letter->post = $request->post;
        $letter->description = $request->description;
        $letter->type = 'letter';
        
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
            
            Storage::disk('public')->put('letter/'.$fileName,$img,'public');
           }

           $letter->image = 'letter/'.$fileName; 

           $letter->save();


        if($letter->id){
            Session::flash('success', 'letters added successfully!');
            return redirect('/admin/letters');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/letters/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/letters/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'post' => 'required',
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'post.required' => 'The Post field is required',
            'description.required' => 'The Description field is required',
        ]);

    
        $letter = SiteIndexes::where('id', $id)->first(); 
        $letter->title = $request->title;
        $letter->name = $request->name;
        $letter->description = $request->description;
        $letter->post = $request->post;
        
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
            
            Storage::disk('public')->put('letter/'.$fileName,$img,'public');

            $letter->image = 'letter/'.$fileName; 
           }

         
           $letter->save();
        
          if($letter->id){
            Session::flash('success', 'letter updated successfully!');
            return redirect('/admin/letters');
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

        echo json_encode(['status'=>true,'message'=>'Agent Deleted Successfully !']);exit();
    }
}
