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
use App\Models\User;
use App\Models\School;
use App\Models\School_Delegates;
use App\Models\Isg_delegates;
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
        $data = Committee::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/committee/index', compact('data'));
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
            'file' => ['required','mimes:pdf', 'max:2055'],
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
            'file.max' => 'file  must be smaller than 2 MB',
            'file.mimes' => 'Input accept only pdf',
        ]);

        $committee = new Committee;
        $committee->name = $request->name;
        $committee->title = $request->title;
        $committee->video = $request->video;
        $committee->sub_title = $request->sub_title;
        $committee->agenda = $request->agenda;
        $committee->description = $request->description;
        
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

           if ($request->hasFile('file')) {
            $doc = $request->file('file');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get();
            
          
            Storage::disk('public')->put('committee/doc/'.$docfileName,$file,'public');
           }

           $committee->file = 'committee/doc/'.$docfileName; 

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video_url);
          
           $committee->video  = $youtubeurl;

           $committee->save();


        if($committee->id){
            Session::flash('success', 'committee added successfully!');
            return redirect('/admin/committee_bureau/'.$committee->id);
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

       
    }

   
    public function show($id)
    {
        $data = Committee::find($id); 
        
        return view('admin/committee/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = Committee::find($id); 
        
        return view('admin/committee/edit', compact('data'));
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
        ],[
            'name.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
            'video.required' => 'The Video field is required',
            'video.url' => 'The Video URL is required',
            'sub_title.required' => 'The Sub Title field is required',
            'agenda.required' => 'The Agenda field is required',
            'description.required' => 'The Description field is required',
           
        ]);

    
        $committee = Committee::where('id', $id)->first();
        $committee->name = $request->name;
        $committee->title = $request->title;
        $committee->sub_title = $request->sub_title;
        $committee->agenda = $request->agenda;
        $committee->description = $request->description;
        
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


        if ($request->hasFile('news_doc')) {

            $validatedData = $request->validate([
                'file' => ['required','mimes:pdf', 'max:2055'],
            ],[
                'file.required' => 'The file field is required',
                'file.max' => 'file  must be smaller than 2 MB',
                'file.mimes' => 'Input accept only pdf',
            ]);


            $doc = $request->file('news_doc');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get();
            
          
            Storage::disk('public')->put('committee/doc/'.$docfileName,$file,'public');

            $committee->file = 'committee/doc/'.$docfileName; 
        }

           $youtubeurl = AdminHelper::getYoutubeIdFromUrl($request->video);
          
           $committee->video  = $youtubeurl;

           $committee->save();
        
          if($committee->id){
            Session::flash('success', 'Committee updated successfully!');
            return redirect('/admin/committee_members/'.$id);
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








    public function committee_delegate($id)
    {
        $data = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '=' , 2)
        ->whereIn('students.status', [1, 2, 3])
        ->where('students.committee_choice', '=' , $id)
        ->orderBy('students.id', 'desc')
        ->paginate(4);
      
       

        return view('admin/committee/delegate_members', compact('data','id'));
    }

    // public function add_delegate(Request $request)
    // {
        
        
    //     $validatedData = $request->validate([
    //         'committe_id' => 'required|max:255',
    //         'delegate_member' => 'required|max:255',
    //     ],[
    //         'committe_id.required' => 'The Title field is required',
    //         'delegate_member.required' => 'The Bureau member field is required',
    //     ]);

    //     $delegate = User::where('id',$request->delegate_member)->first();
        

    //     $members = new Committee_member;
    //     $members->committe_id = $request->committe_id;
    //     $members->name = $delegate->name;
    //     $members->user_id = $delegate->id;
    //     $members->title = '';
    //     $members->image = $delegate->avatar;
    //     $members->save();


    //     if($members->id){
    //         Session::flash('success', 'Delegate member added successfully!');
    //         return  redirect()->back();
    //       }else{
    //         Session::flash('error', 'Something went wrong!!');
    //         return  redirect()->back();
    //       }
       
    // }




    // public function delete_delegate(Request $request,$id)
    // {

    //     $mytime = Carbon::now();
    //     $timestamp=$mytime->toDateTimeString();

    //     $member = Committee_member::where('id', $id)->first(); 
    //     $member->deleted_at = $timestamp;
    //     $member->delete();

    //     echo json_encode(['status'=>true,'message'=>'Committee member Deleted Successfully !']);exit();
    // }



    public function committee_bureau($id)
    {
        $data = user::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role')
        ->where('users.role', '=' , 3)
        ->whereIn('students.status', [1, 2, 3])
        ->where('students.committee_choice', '=' , $id)
        ->orderBy('students.id', 'desc')
        ->paginate(4);

        return view('admin/committee/bureau_members', compact('data','id'));
    }

    // public function add_bureau(Request $request)
    // {
        
        
    //     $validatedData = $request->validate([
    //         'committe_id' => 'required|max:255',
    //         'bureau_member' => 'required|max:255',
    //         'title' => 'required|max:255'
    //     ],[
    //         'committe_id.required' => 'The Title field is required',
    //         'bureau_member.required' => 'The Bureau member field is required',
    //         'title.required' => 'The Title field is required',
    //     ]);

    //     $bureau_member = User::where('id',$request->bureau_member)->first();
        

    //     $members = new Committee_member;
    //     $members->committe_id = $request->committe_id;
    //     $members->name = $bureau_member->name;
    //     $members->user_id = $bureau_member->id;
    //     $members->title = $request->title;
    //     $members->image = $bureau_member->avatar;
    //     $members->save();


    //     if($members->id){
    //         Session::flash('success', 'bureau members added successfully!');
    //         return  redirect()->back();
    //       }else{
    //         Session::flash('error', 'Something went wrong!!');
    //         return  redirect()->back();
    //       }
       
    // }




    // public function delete_bureau(Request $request,$id)
    // {
    //     $mytime = Carbon::now();
    //     $timestamp=$mytime->toDateTimeString();

    //     $member = Committee_member::where('id', $id)->first(); 
    //     $member->deleted_at = $timestamp;
    //     $member->delete();

      

    //     echo json_encode(['status'=>true,'message'=>'Committee bureau member Deleted Successfully !']);exit();
    // }




    // public function get_delegate(Request $request)
    // {
        
        
    //    $userid = $request->user_id;

    //    $user = User::where('id', $userid)->where('deleted_at', null)->first();   
    //    $type = $user->type;
    //     if($type == '1'){
    //         $delegate = School_Delegates::where('user_id', $user->id)->first();  
    //         $school = School::where('id', $delegate->school_id)->first(); 
    //         $delegate['school'] = $school->name;
    //     }elseif($type == '0'){
    //         $delegate = Isg_delegates::where('user_id', $user->id)->where('deleted_at', null)->first();
    //         $school =''; 
    //         $delegate['school'] = $school;
    //     }


    //     if($delegate->id){
    //         echo json_encode(['status'=>true,'data'=>$delegate]);exit();
    //       }else{
    //         echo json_encode(['status'=>true,'message'=>'Something went wrong']);exit();
    //       }
       
    // }



}
