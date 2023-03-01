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
use App\Models\Committee;
use App\Models\Committee_member;
use App\Models\Committee_files;
use App\Models\User;
use App\Models\School;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class CommitteeController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','committee');
    }
  
    public function index(Request $request)
    {   
        $query = Committee::where('deleted_at', null);
        if($request->q){
            $query->where('name','LIKE', $request->q)
            ->orwhere('title','LIKE', $request->q);
        }
        $data=$query->orderBy('position', 'ASC')
                    ->paginate(10); 
        return view('admin/committee/index', compact('data','request'));
    }

    
    public function create()
    {
        return view('admin/committee/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' =>'required|max:255',
            'title' =>'required|max:255',
            'sub_title' =>'required|max:255',
            'agenda' =>'required|max:255',
            'video' =>'required|max:255',
            'description' =>'required',
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:2055'],
             'guide' => 'required|mimes:pdf|max:2055',
             'guide.*'  => ['required','mimes:pdf', 'max:2055'],
             'position' =>'required|max:255',
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'video.required' => 'The Video field is required',
            'video.url' => 'The Video URL is required',
            'sub_title.required' => 'The Sub Title field is required',
            'agenda.required' => 'The Agenda field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'file.required' => 'The file field is required',
            'guide.required' => 'The file field is required',
            'guide.max' => 'file  must be smaller than 2 MB',
            'guide.mimes' => 'Input accept only pdf',
            'position.required' => 'The Position field is required',
        ]);

        $committee = new Committee;
        $committee->name = $request->name;
        $committee->title = $request->title;
        $committee->video = $request->video;
        $committee->sub_title = $request->sub_title;
        $committee->agenda = $request->agenda;
        $committee->description = $request->description;
        $committee->position = $request->position;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(443,161, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('committee/'.$fileName,$img,'public');
           }

           $committee->image = 'committee/'.$fileName; 


           if ($request->hasFile('guide')) {
            $guide = $request->file('guide');
            $guidefileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $guide->getClientOriginalExtension();
                    $file = $guide->get();
                    $origin_name = $guide ->getClientOriginalName();
                    Storage::disk('public')->put('committee/guide/'.$guidefileName,$file,'public');
           }

           $committee->file = 'committee/guide/'.$guidefileName; 

           

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video_url);
          
           $committee->video  = $youtubeurl;

           $committee->save();


        if($committee->id){

       
            if ($request->hasFile('file')) {

                $doc = $request->file('file');

                for($count = 0; $count < count($doc); $count++)
                {
                    $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc[$count]->getClientOriginalExtension();
                    $file = $doc[$count]->get();
                    $origin_name = $doc[$count] ->getClientOriginalName();
                    Storage::disk('public')->put('committee/doc/'.$docfileName,$file,'public');
                    
                    $committeefile = new Committee_files;
                    $committeefile->committe_id = $committee->id;
                    $committeefile->name = $origin_name;
                    $committeefile->file = 'committee/doc/'.$docfileName;
                    $committeefile->save();
               }
            }

           
        }

        if($committee->id){
            Session::flash('success', 'committee added successfully!');
            return redirect('/admin/committee');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

       
    }

   
    public function show($id)
    {
          
      
        $data  = Committee::find($id); 
        $files = Committee_files::where('committe_id', $id)->where('deleted_at', null)->get(); 
       
        return view('admin/committee/show', compact('data','files'));
    }

   
    public function edit($id)
    {
        $data = Committee::find($id); 
        $files = Committee_files::where('committe_id', $id)->where('deleted_at', null)->get(); 
        return view('admin/committee/edit', compact('data','files'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'name' =>'required|max:255',
            'title' =>'required|max:255',
            'sub_title' =>'required|max:255',
            'agenda' =>'required|max:255',
            'video' =>'required|max:255',
            'description' =>'required',
            'position' =>'required',
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'video.required' => 'The Video field is required',
            'video.url' => 'The Video URL is required',
            'sub_title.required' => 'The Sub Title field is required',
            'agenda.required' => 'The Agenda field is required',
            'description.required' => 'The Description field is required',
            'position.required' => 'The Position field is required',
           
        ]);

    
        $committee = Committee::where('id', $id)->first();
        $committee->name = $request->name;
        $committee->title = $request->title;
        $committee->sub_title = $request->sub_title;
        $committee->agenda = $request->agenda;
        $committee->description = $request->description;
        $committee->position = $request->position;
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
                $img->resize(443,161, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('committee/'.$fileName,$img,'public');

            $committee->image = 'committee/'.$fileName; 
        }


        if ($request->hasFile('guide')) {
            $guide = $request->file('guide');
            $guidefileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $guide->getClientOriginalExtension();
                    $file = $guide->get();
                    $origin_name = $guide ->getClientOriginalName();
                    Storage::disk('public')->put('committee/guide/'.$guidefileName,$file,'public');
           

           $committee->file = 'committee/guide/'.$guidefileName; 
        }

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video);
          
           $committee->video  = $youtubeurl;

           $committee->save();


           if($committee->id){

       
            if ($request->hasFile('file')) {

                // $validatedData = $request->validate([
                //     'file' => 'required|array|mimes:pdf|max:2055',
                //     'file.*'  => ['required','mimes:pdf', 'max:2055'],
                // ],[
                //     'file.required' => 'The file field is required',
                //     'file.max' => 'file  must be smaller than 2 MB',
                //     'file.mimes' => 'Input accept only pdf',
                // ]);
    

                $doc = $request->file('file');

               for($count = 0; $count < count($doc); $count++)
               {
                    $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc[$count]->getClientOriginalExtension();
                    $file = $doc[$count]->get();
                    $origin_name = $doc[$count] ->getClientOriginalName();
                    Storage::disk('public')->put('committee/doc/'.$docfileName,$file,'public');
                    
                    $committeefile = new Committee_files;
                    $committeefile->committe_id = $committee->id;
                    $committeefile->name = $origin_name;
                    $committeefile->file = 'committee/doc/'.$docfileName;
                    $committeefile->save();
               }
            }

           
        }

        
          if($committee->id){
            Session::flash('success', 'Committee updated successfully!');
            return redirect('/admin/committee');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

           
    }

    
    public function destroy(Request $request,$id)
    {

        $Committee = Committee::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $Committee->deleted_at = $timestamp;
        $Committee->save();

        echo json_encode(['status'=>true,'message'=>'Committee Deleted Successfully !']);exit();
    }


    public function file_destroy(Request $request,$id)
    {

        $file = Committee_files::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $file->deleted_at = $timestamp;
        $file->save();

        echo json_encode(['status'=>true,'message'=>'Committee file Deleted Successfully !']);exit();
    }





    public function committee_delegate(Request $request,$id)
    {
        $query = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '=' , 2)
        ->whereIn('students.status', [1, 2, 3])
        ->where('students.committee_choice', '=' , $id);
        if($request->q){
            $query->where('students.name','LIKE', $request->q);
        }
        $data = $query->orderBy('students.id', 'desc')
        ->paginate(4);
      
       

        return view('admin/committee/delegate_members', compact('data','id','request'));
    }

   


    public function committee_bureau(Request $request,$id)
    {
        $query = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '=' , 3)
        ->whereIn('students.status', [1, 2, 3])
        ->where('students.committee_choice', '=' , $id);
        if($request->q){
            $query->where('students.name','LIKE', $request->q);
        }
        $data = $query->orderBy('students.id', 'desc')
        ->paginate(4);

        return view('admin/committee/bureau_members', compact('data','id','request'));
    }

    



}
