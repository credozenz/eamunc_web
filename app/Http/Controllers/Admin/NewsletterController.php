<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\Newsletter;

use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class NewsletterController extends Controller
{
  
    public function index(Request $request)
    {
       
        $data = Newsletter::where('deleted_at', null)->paginate(10); 
        Alert::message('Tickets retrieved!');
        
        return view('admin/newsletter/index', compact('data'));
       
    }

    
    public function create()
    {
        return view('admin/newsletter/create');
    }

    
    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['required','mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            'news_doc' => ['required','mimes:pdf', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.required' => 'The Image field is required',
            'news_doc.required' => 'The PDF field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'news_doc.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'news_doc.mimes' => 'Input accept only pdf',
        ]);

        $news = new Newsletter;
        $news->title = $request->title;
        $news->description  = $request->description;
        
        
        
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
            
            Storage::disk('public')->put('newsletter/image/'.$fileName,$img,'public');
           }

           $news->image = 'newsletter/image/'.$fileName; 


           if ($request->hasFile('news_doc')) {
            $doc = $request->file('news_doc');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
            $file = $doc->get();
            
          
            Storage::disk('public')->put('newsletter/doc/'.$docfileName,$file,'public');
           }

           $news->news_file = 'newsletter/doc/'.$docfileName; 


           $news->save();
           

           return  redirect()->back()->with('status',"Newsletter successfully");
    }

   
    public function show($id)
    {
        $data = Newsletter::find($id); 
        
        return view('admin/newsletter/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data = Newsletter::find($id); 
        
        return view('admin/newsletter/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            'news_doc' => ['mimes:pdf', 'max:255'],
        ],[
            'title.required' => 'The Title field is required',
            'description.required' => 'The Description field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'news_doc.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'news_doc.mimes' => 'Input accept only pdf',
        ]);

    
        $news = Newsletter::where('id', $id)->first(); 
        $news->title = $request->title;
        $news->description  = $request->description;
        
       
        
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
            
            Storage::disk('public')->put('newsletter/image/'.$fileName,$img,'public');

            $news->image = 'newsletter/image/'.$fileName; 
           }

           


           if ($request->hasFile('news_doc')) {
            $doc = $request->file('news_doc');
            $docfileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $doc->getClientOriginalExtension();
          
            $extension=$doc->getClientOriginalExtension();
           
            $file = $doc->get();
            
          
            Storage::disk('public')->put('newsletter/doc/'.$docfileName,$file,'public');

            $news->news_file = 'newsletter/doc/'.$docfileName; 
           }

          


           $news->save();
           

           return  redirect()->back()->with('status',"Newsletter successfully");
    }

    
    public function destroy(Request $request,$id)
    {

        $news = Newsletter::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $news->deleted_at = $timestamp;
        $news->save();

        echo json_encode(['status'=>true,'message'=>'Agent Deleted Successfully !']);exit();
    }
}
