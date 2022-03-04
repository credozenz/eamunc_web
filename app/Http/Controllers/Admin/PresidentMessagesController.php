<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Helper\AdminHelper;
use App\Models\president_message;

use Carbon\Carbon;
use Str;
use Image;
use Storage;
use Alert;
use League\Flysystem\File;

class PresidentMessagesController extends Controller
{
  
    public function index(Request $request)
    {
       
        $data = president_message::find(1); 
        
        return view('admin/presidentMessage/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'post' => 'required|max:255',
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255']
        ],[
            'title.required' => 'The Title field is required',
            'name.required' => 'The Name field is required',
            'post.required' => 'The Post field is required',
            'description.required' => 'The Description field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

    
        $news = president_message::where('id', 1)->first(); 
        $news->title = $request->title;
        $news->name = $request->name;
        $news->post = $request->post;
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
            
            Storage::disk('public')->put('president_image/'.$fileName,$img,'public');

            $news->image = 'president_image/'.$fileName; 
           }

           $news->save();
           

           return  redirect()->back()->with('status',"president message add successfully");
    }

    
   
}
