<?php

namespace App\Http\Controllers\App\Bureau;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Route;
use App\Helper\WebAppHelper;
use App\Models\SiteIndexes;
use App\Models\School;
use App\Models\Committee;
use App\Models\Blocs;
use App\Models\Bloc_members;
use App\Models\Bloc_chats;
use App\Models\User;
use Carbon\Carbon;
use View;
class BureauBlocChatController extends Controller
{

    public function __construct()
    {
        $routeName  = Route::currentRouteName();
        View::share('routeGroup','bureau_bloc_formation');

    }

    public function index(Request $request,$id)
    {
        $member = WebAppHelper::getLogMember();
       
        $committee = Committee::where('id',$member->committee_choice)->first();

        $committee_bloc = Blocs::where('committe_id',$member->committee_choice)->get();

        $blocs_members = DB::table('users as u')
                            ->join('bloc_members as b', 'u.id', '=', 'b.user_id')
                            ->select('u.*')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->where('b.bloc_id', '=', $id)
                            ->get();

          $blocs_chats = DB::table('bloc_chat as b')
                            ->join('users as u', 'b.user_id', '=', 'u.id')
                            ->select('b.*','u.name as user_name','u.avatar as avatar')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->where('b.bloc_id', '=', $id)
                            ->get();

        return view('app/bureau/bloc_chat', compact('id','member','committee','committee_bloc','blocs_members','blocs_chats'));
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
