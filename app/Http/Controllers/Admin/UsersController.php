<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
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

class UsersController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','users');
    }
  
    public function index(Request $request)
    {   
        $query = User::where('deleted_at', null)->where('role', 4);
        if($request->q){
            $query->orwhere('name','LIKE', $request->q)
            ->orwhere('title','LIKE', $request->q);
        }
        $data=$query->orderBy('id', 'DESC')
                    ->paginate(10); 
        return view('admin/users/index', compact('data','request'));
    }

    
    public function create()
    {
        return view('admin/users/create');
    }

    
    public function store(Request $request)
    {

        
        $validatedData = $request->validate([
           
            "name"    => "required",
            "phone"    => "required",
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required|same:password'
           
        ],[
            
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email ID',
            'email.unique' => 'Email id already exists',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'email.required' => 'The email field is required',
            'password.min' => 'The password min 8 required',
            'password.string' => 'The password include string',
            'password.required' => 'The password field is required',
            'password_confirmation.required' => 'The password confirmation field is required',
            'password_confirmation.same' => 'Password and confirm password must match',
        ]);
      
       
        $name = $request->input('name');
        $email = $request->input('email');
        $phone_no = $request->input('phone');
        $password = $request->input('password');
                
                $useremail = User::where('email', $email); 
               
                if(!empty($useremail->count())){
                    Session::flash('error', 'Email id already exists !');
                    return  redirect()->back();
                }

                $userphone = User::where('phone', $phone_no); 
               
                if(!empty($useremail->count())){
                    Session::flash('error', 'Phone no already exists !');
                    return  redirect()->back();
                }
                    
                    $user = new User;
                    $user->name  = $name;
                    $user->email = $email;
                    $user->password = Hash::make($password);
                    $user->phone = !empty($phone_no)? $phone_no:NULL;
                    $user->role = 4;
                    $user->type = 3;
                    $user->status = 1;

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
                        
                        Storage::disk('public')->put('user_image/'.$fileName,$img,'public');
            
                        $user->avatar = 'user_image/'.$fileName; 
                       }
            


                    $user->save();
                
                   

               

         
         
            if(isset($user->id)){
                Session::flash('success', 'User Added successfully Completed!');
                return redirect('/admin/users');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }

      
       
    }

   
    public function show($id)
    {
          
      
        $data  = User::find($id); 
       
        return view('admin/users/show', compact('data'));
    }

   
    public function edit($id)
    {
        $data  = User::find($id); 
        return view('admin/users/edit', compact('data'));
    }

    
    public function update(Request $request, $id)
    {


        $validatedData = $request->validate([
           
            "name"    => "required",
            "phone"    => "required",
            'image' => ['mimes:jpeg,png,jpg,gif,svg', 'max:255'],
            'email' => 'required|email',
            // 'password' => 'required|string|min:8|confirmed',
            // 'password_confirmation' => 'required|same:password'
           
        ],[
            
            'name.required' => 'The Name field is required',
            'email.required' => 'The Email field is required',
            'email.email' => 'Please put valid email ID',
            'email.unique' => 'Email id already exists',
            'image.max' => 'Image  must be smaller than 2 MB',
            'image.mimes' => 'Input accept only jpeg,png,jpg,gif,svg',
            'email.required' => 'The email field is required',
            //'email.exists' => 'Undefined email',
            // 'password.min' => 'The password min 8 required',
            // 'password.string' => 'The password include string',
            // 'password.required' => 'The password field is required',
            // 'password_confirmation.required' => 'The password confirmation field is required',
            // 'password_confirmation.same' => 'Password and confirm password must match',
        ]);
      
       
        $name = $request->input('name');
        $email = $request->input('email');
        $phone_no = $request->input('phone');
        $password = $request->input('password');
                
        $useremail = User::where('email', $email)->where('id', '<>',$id); 
               
        if(!empty($useremail->count())){
            Session::flash('error', 'Email id already exists !');
            return  redirect()->back();
        }

        $userphone = User::where('phone', $phone_no)->where('id', '<>',$id); 
       
        if(!empty($useremail->count())){
            Session::flash('error', 'Phone no already exists !');
            return  redirect()->back();
        }
            
               
              
                    $user = User::where('id',$id)->first();
                    $user->name  = $name;
                    $user->email = $email;

                    if(!empty($password)){
                        $user->password = Hash::make($password);
                    }
                    
                    $user->phone = !empty($phone_no)? $phone_no:NULL;
                    $user->role = 4;
                    $user->type = 3;
                    $user->status = 1;


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
                        
                        Storage::disk('public')->put('user_image/'.$fileName,$img,'public');
            
                        $user->avatar = 'user_image/'.$fileName; 
                       }
            


                    $user->save();
                
                   

             

         
         
            if(isset($user->id)){
                Session::flash('success', 'User Updated successfully Completed!');
                return redirect('/admin/users');
            }else{
                Session::flash('error', 'Something went wrong!!');
                return  redirect()->back();
            }
        
     

           
    }

    
    public function destroy(Request $request,$id)
    {

        $Committee = User::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $Committee->deleted_at = $timestamp;
        $Committee->save();

        echo json_encode(['status'=>true,'message'=>'User Deleted Successfully !']);exit();
    }


    




    



}
