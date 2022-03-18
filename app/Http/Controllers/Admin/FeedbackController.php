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
use App\Models\Feedback_qsn;
use App\Models\Feedback;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class FeedbackController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','footer');
    }



    public function feedback(Request $request)
    {   
        View::share('routeGroup','feedback');
        $data = Feedback::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(10); 
        return view('admin/feedback/feedback', compact('data'));
    }


    public function feedback_show($id)
    {
        View::share('routeGroup','feedback');
        
        $data = Feedback_qsn::find($id);


        $feedback = Feedback::where('feedback.id', $id)
                            ->join('committees','committees.id','=','feedback.committee')
                            ->select('feedback.*','committees.name as committee_name')
                            ->first(); 

                            //dd($feedback);
        
        return view('admin/feedback/feedback_show', compact('data','feedback'));
    }




  
    public function index(Request $request)
    {   
        $data = Feedback_qsn::where('deleted_at', null)->orderBy('id', 'DESC')->paginate(10); 
        return view('admin/feedback/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/feedback/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'question' => 'required|max:255',
        ],[
            'question.required' => 'The question field is required',
        ]);

        $qsn = new Feedback_qsn;
        $qsn->question = $request->question;
        $qsn->save();


        if($qsn->id){
            Session::flash('success', 'feedback question added successfully!');
            return redirect('/admin/feedback');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
  
    }

   
    
   
    public function edit($id)
    {
        $data = Feedback_qsn::find($id); 
        
        return view('admin/feedback/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'question' => 'required',
        ],[
            'question.required' => 'The question field is required',
        ]);

    
        $qsn = Feedback_qsn::where('id', $id)->first(); 
        $qsn->question = $request->question;
        $qsn->save();
        
          if($qsn->id){
            Session::flash('success', 'feedback question updated successfully!');
            return redirect('/admin/feedback');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }    
    }

    
    public function destroy(Request $request,$id)
    {

        $news = Feedback_qsn::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'feedback question Deleted Successfully !']);exit();
    }
}
