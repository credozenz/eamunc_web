<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use View;
use App\Helper\AdminHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\School_Delegates;
use App\Models\Isg_delegates;
use App\Models\Committee;
use App\Models\User;
use Carbon\Carbon;
use Str;
use Image;
use Storage;
use League\Flysystem\File;

class MembersController extends Controller
{
    public function __construct()
    {
        View::share('routeGroup','members');
    }
    
    public function members(Request $request)
    {
        $data = User::where('deleted_at', null)->where('deleted_at', null)->where('role', '!=' , 1)->orderBy('id', 'DESC')->paginate(5); 
       
        return view('admin/members/index', compact('data'));
       
    }

    public function members_show(Request $request,$id)
    {
       
       $user = User::where('id', $id)->where('deleted_at', null)->first();   
       $type = $user->type;
        if($type == '2'){
            $data = School_Delegates::where('user_id', $user->id)->first();  
            $school = School::where('id', $data->school_id)->first(); 
        }elseif($type == '1'){
            $data = Isg_delegates::where('user_id', $user->id)->where('deleted_at', null)->first();
            $school =''; 
        }
        
        
        return view('admin/members/show', compact('data','type','school','user','id'));
       
    }

    


    public function member_rolechange(Request $request,$id)
    {
        $committee_member = DB::table('users as u')
        ->leftjoin('committee_members as cm', 'cm.user_id', '=', 'u.id')
        ->select('u.*')
        ->where([['u.deleted_at', null],['cm.deleted_at', null],['u.id',$id],['cm.user_id', null]])
        ->get();
        if(empty($committee_member)){
        $user = User::where('id', $id)->first(); 
        $user->role = $request->status;
        $user->save();

        if($user){
            echo json_encode(['status'=>true,'message'=>'Member role changed Successfully !']);exit();
        }else{
            echo json_encode(['status'=>false,'message'=>'Something went wrong please try again !']);exit();
        }
        
    }else{
        echo json_encode(['status'=>false,'message'=>'This member has already been added to a committee, Please remove and try again !']);exit();
    }
    }



    
}
