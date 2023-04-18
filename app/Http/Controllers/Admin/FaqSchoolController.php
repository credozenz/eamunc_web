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

class FaqSchoolController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','footer');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'faq')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/faq/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/faq/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
        ],[
            'description.required' => 'The Description field is required',
            'title.required' => 'The Title field is required',
        ]);

        $faq = new SiteIndexes;
        $faq->title = $request->title;
        $faq->description = $request->description;
        $faq->type = 'faq';
        $faq->save();


        if($faq->id){
            Session::flash('success', 'faq added successfully!');
            return redirect('/admin/faq');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/faq/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/faq/edit', compact('data'));
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

    
        $faq = SiteIndexes::where('id', $id)->first(); 
        $faq->title = $request->title;
        $faq->description  = $request->description;
        $faq->save();
        
          if($faq->id){
            Session::flash('success', 'faq updated successfully!');
            return redirect('/admin/faq');
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

        echo json_encode(['status'=>true,'message'=>'Faq Deleted Successfully !']);exit();
    }
}
