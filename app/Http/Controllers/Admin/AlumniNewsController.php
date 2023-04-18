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

class AlumniNewsController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','alumni');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'alumni_news')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/alumninews/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/alumninews/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $alumni_news = new SiteIndexes;
        $alumni_news->title = $request->title;
        $alumni_news->description = $request->description;
        $alumni_news->type = 'alumni_news';
        
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
            
            Storage::disk('public')->put('alumninews/'.$fileName,$img,'public');
           }

           $alumni_news->image = 'alumninews/'.$fileName; 

           $alumni_news->save();


        if($alumni_news->id){
            Session::flash('success', 'Alumni news added successfully!');
            return redirect('/admin/alumninews');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/alumninews/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/alumninews/edit', compact('data'));
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

    
        $alumni_news = SiteIndexes::where('id', $id)->first(); 
        $alumni_news->title = $request->title;
        $alumni_news->description = $request->description;
        
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
            
            Storage::disk('public')->put('alumninews/'.$fileName,$img,'public');

            $alumni_news->image = 'alumninews/'.$fileName; 
           }

         
           $alumni_news->save();
        
          if($alumni_news->id){
            Session::flash('success', 'Alumni news updated successfully!');
            return redirect('/admin/alumninews');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }
    public function archive(Request $request,$id)
    {

        $news = SiteIndexes::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $status = $request->input('status');
        $news->status = $status;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Newsletter Archive Successfully !']);exit();
    }

    
    public function destroy(Request $request,$id)
    {

        $news = SiteIndexes::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Alumni news Deleted Successfully !']);exit();
    }
}
