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

class BannerController extends Controller
{

    public function __construct()
    {
        View::share('routeGroup','banner');
    }
  
    public function index(Request $request)
    {   

        $data = SiteIndexes::where('deleted_at', null)->where('type', 'banner')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/banner/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/banner/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'max:255',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
        ],[
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $letter = new SiteIndexes;
        $letter->title = $request->title;
        $letter->type = 'banner';
        
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
            
            Storage::disk('public')->put('banner/'.$fileName,$img,'public');
           }

           $letter->image = 'banner/'.$fileName; 

           $letter->save();


        if($letter->id){
            Session::flash('success', 'banner added successfully!');
            return redirect('/admin/banner');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/banner/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/banner/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'max:255',
        ],[
            'title.required' => 'The Title field is required',
        ]);

    
        $letter = SiteIndexes::where('id', $id)->first(); 
        $letter->title = $request->title;
        
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
            
            Storage::disk('public')->put('banner/'.$fileName,$img,'public');

            $letter->image = 'banner/'.$fileName; 
           }

         
           $letter->save();
        
          if($letter->id){
            Session::flash('success', 'banner updated successfully!');
            return redirect('/admin/banner');
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

        echo json_encode(['status'=>true,'message'=>'banner Deleted Successfully !']);exit();
    }
}
