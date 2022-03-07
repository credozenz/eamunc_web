<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\Committee_members;

use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class CommitteeMembersController extends Controller
{
  
    public function index(Request $request)
    {   
        $data = Committee_members::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/committeeMembers/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/committeeMembers/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

        $member = new Committee_members;
        $member->title = $request->title;
        $member->name = $request->name;
        
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
            
            Storage::disk('public')->put('committee_members/'.$fileName,$img,'public');
           }

           $member->image = 'committee_members/'.$fileName; 

           $member->save();


        if($member->id){
            Session::flash('success', 'Committee members added successfully!');
            return redirect('/admin/committee_members');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = Committee_members::find($id); 
        
        return view('admin/committeeMembers/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = Committee_members::find($id); 
        
        return view('admin/committeeMembers/edit', compact('data'));
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

    
        $member = Committee_members::where('id', $id)->first(); 
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
                $img->resize(100, 100, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('committee_members/'.$fileName,$img,'public');

            $member->image = 'committee_members/'.$fileName; 
           }

         
           $member->save();
        
          if($member->id){
            Session::flash('success', 'Committee members updated successfully!');
            return redirect('/admin/committee_members');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }

    
    public function destroy(Request $request,$id)
    {

        $news = Committee_members::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Committee members Deleted Successfully !']);exit();
    }
}
