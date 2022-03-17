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

class MentorsController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','about');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'our_mentors')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/ourmentors/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/ourmentors/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $mentors = new SiteIndexes;
        $mentors->title = $request->title;
        $mentors->name = $request->name;
        $mentors->description = $request->description;
        $mentors->type = 'our_mentors';
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(351, 400, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('our_mentors/'.$fileName,$img,'public');
           }

           $mentors->image = 'our_mentors/'.$fileName; 

           $mentors->save();


        if($mentors->id){
            Session::flash('success', 'Mentors added successfully!');
            return redirect('/admin/our_mentors');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/ourmentors/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/ourmentors/edit', compact('data'));
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

    
        $mentors = SiteIndexes::where('id', $id)->first(); 
        $mentors->title = $request->title;
        $mentors->name = $request->name;
        $mentors->description = $request->description;
        
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
                $img->resize(351, 400, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('our_mentors/'.$fileName,$img,'public');

            $mentors->image = 'our_mentors/'.$fileName; 
           }

         
           $mentors->save();
        
          if($mentors->id){
            Session::flash('success', 'Mentors updated successfully!');
            return redirect('/admin/our_mentors');
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
