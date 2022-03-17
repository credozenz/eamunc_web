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

class ImportantDateController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','conference');
    }
  
    public function index(Request $request)
    {   
        $data = SiteIndexes::where('deleted_at', null)->where('type', 'important_date')->orderBy('id', 'DESC')->paginate(4); 
        return view('admin/importantdate/index', compact('data'));
    }

    
    public function create()
    {
        return view('admin/importantdate/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'date' => 'required|max:255',
            'title' => 'required|max:255',
        ],[
            'title.required' => 'The Title field is required',
            'date.required' => 'The Image field is required',
        ]);

        $date = new SiteIndexes;
        $date->title = $request->title;
        $date->date =  date('Y-m-d',strtotime($request->date));
        $date->type = 'important_date';    

        $date->save();


        if($date->id){
            Session::flash('success', 'Important date added successfully!');
            return redirect('/admin/importantdate');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }

          
        
    }

   
    public function show($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/importantdate/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = SiteIndexes::find($id); 
        
        return view('admin/importantdate/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'date' => 'required|max:255',
            'title' => 'required|max:255',
        ],[
            'date.required' => 'The Name field is required',
            'title.required' => 'The Title field is required',
        ]);

    
        $date = SiteIndexes::where('id', $id)->first(); 
        $date->title = $request->title;
        $date->date = date('Y-m-d',strtotime($request->date));
        
           $date->save();
        
          if($date->id){
            Session::flash('success', 'Mentors updated successfully!');
            return redirect('/admin/importantdate');
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
