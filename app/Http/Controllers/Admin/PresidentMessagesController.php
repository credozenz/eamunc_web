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
use Alert;
use League\Flysystem\File;

class PresidentMessagesController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','home');
    }
    
    public function index(Request $request)
    {
        $data = SiteIndexes::where('deleted_at', null)->where('type','president_messages')->first(); 
      
        return view('admin/presidentMessage/index', compact('data'));
       
    }

    
   
    
    public function update(Request $request)
    {
        
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'name' => 'required|max:255',
            'post' => 'required|max:255',
            'description' => ['required'],
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:2050']
        ],[
            'title.required' => 'The Title field is required',
            'name.required' => 'The Name field is required',
            'post.required' => 'The Post field is required',
            'description.required' => 'The Description field is required',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
        ]);

    
        $message = SiteIndexes::where('type', 'president_messages')->first(); 
        $message->title = $request->title;
        $message->name = $request->name;
        $message->post = $request->post;
        $message->description  = $request->description;
        $message->type  = 'president_messages';
       
        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $fileName   =  time().'_'.str_random(5).'_'.rand(1111,9999). '.' . $image->getClientOriginalExtension();
          
            $extension=$image->getClientOriginalExtension();
           
            if($extension=='svg'){
               $img = $image->get();
            }else{
                $img = Image::make($image->getRealPath());
                $img->resize(440, 528, function ($constraint) {
                   $constraint->aspectRatio();                 
                });
                $img->stream('png', 100);
            }
            
            Storage::disk('public')->put('president_image/'.$fileName,$img,'public');

            $message->image = 'president_image/'.$fileName; 
           }

           $message->save();
           
           if($message->id){
            Session::flash('success', 'President messages updated successfully!');
            return redirect('/admin/president_messages');
          }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
          }
           
    }

    
   
}
