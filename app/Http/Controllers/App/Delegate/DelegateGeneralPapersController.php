<?php

namespace App\Http\Controllers\App\Delegate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helpers\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\Bloc_chats;
use App\Models\User;
use Carbon\Carbon;
use View;
class DelegateGeneralPapersController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','delegate_general_papers');

    }

    public function index(Request $request)
    {
        $member = WebAppHelper::getLogMember();
       
        $committee = Committee::where('id',$member->committee_choice)->first();

      

       
        return view('app/delegate/general_papers', compact('member','committee'));
    }



    public function store(Request $request,$id)
    {

        $validatedData = $request->validate([
            'message'    => 'required|max:255',
        ],[
            'message.required' => 'The Message field is required', 
        ]);


        $member = WebAppHelper::getLogMember();
        
        $committee = Committee::where('id',$member->committee_choice)->first();
       
        $user_id  = $member->user_id;
        $committe_id  = $committee->id;

        
        $chat = new Bloc_chats;
        $chat->bloc_id = $id;
        $chat->user_id = $user_id;
        $chat->committe_id = $committe_id;
        $chat->message = $request->message;
        $chat->save();

            
        if($chat->id){
            Session::flash('success', 'Message Send !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }


}
