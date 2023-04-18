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

class WorkMembersController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','conference');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'work_members')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/workMembers/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/workMembers/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $member = new SiteIndexes;
        $member->title = $request->title;
        $member->name = $request->name;
        $member->type = 'work_members';

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(256, 291, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('work_members/'.$fileName,$img,'public');
           }

           $member->image = 'work_members/'.$fileName; 

           $member->save();


        if($member->id){
            Session::flash('success', 'Work members added successfully!');
            return redirect('/admin/work_members');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/workMembers/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/workMembers/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
        ]);

    
        $member = SiteIndexes::where('id', $id)->first(); 
        $member->title = $request->title;
        $member->name = $request->name;
       
        
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
                $img->resize(256, 291, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('work_members/'.$fileName,$img,'public');

            $member->image = 'work_members/'.$fileName; 
           }

         
           $member->save();
        
          if($member->id){
            Session::flash('success', 'Work members updated successfully!');
            return redirect('/admin/work_members');
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

        echo json_encode(['status'=>true,'message'=>'Work members Deleted Successfully !']);exit();
    }
}
