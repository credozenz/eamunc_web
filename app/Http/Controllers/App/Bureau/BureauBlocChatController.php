<?php

namespace App\Http\Controllers\App\Bureau;

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
use Str;
use Image;
use Storage;
use League\Flysystem\File;
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

        $committee_bloc = Blocs::where('id',$id)->first();

        $blocs_members = DB::table('users as u')
                            ->join('bloc_members as b', 'u.id', '=', 'b.user_id')
                            ->select('u.*')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->where('b.bloc_id', '=', $id)
                            ->get();

          $blocs_chats = DB::table('bloc_chats as b')
                            ->join('users as u', 'b.user_id', '=', 'u.id')
                            ->select('b.*','u.name as user_name','u.avatar as avatar')
                            ->where('u.deleted_at', null)
                            ->where('b.deleted_at', null)
                            ->where('b.bloc_id', '=', $id)
                            ->orderBy('b.id', 'ASC')
                            ->paginate(2000);

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


        $message = $request->message;
        $type = 'text';



        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '_' . str_random(5) . '_' . rand(1111, 9999) . '.' . $file->getClientOriginalExtension();
            $extension = $file->getClientOriginalExtension();
          
            if (in_array($extension, ['svg', 'png', 'jpg', 'jpeg', 'gif'])) {
                $type = 'image';

                if ($extension == 'svg') {
                    $img = $file->get();
                } else {
                    $img = Image::make($file->getRealPath());
                    $img->resize(1296, 845, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->stream('png', 100);
                }


            } else if (in_array($extension, ['doc', 'docx', 'pdf', 'xls', 'xlsx'])) {
                $type = 'file';
                $img = $file->get();
            } else {
                Session::flash('error', 'Handle unsupported file formats!!');
                return  redirect()->back();
            }


               
                
                Storage::disk('public')->put('chat/' . $fileName, $img, 'public');
                $message = 'chat/' . $fileName;
               
            
        }




        $chat = new Bloc_chats;
        $chat->bloc_id = $id;
        $chat->user_id = $user_id;
        $chat->committe_id = $committe_id;
        $chat->message = $message;
        $chat->type = $type;
        $chat->save();

            
        if($chat->id){
            Session::flash('success', 'Message Send !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    

    }


    public function destroy(Request $request,$id)
    {

        $chat = Bloc_chats::where('id', $id)->first(); 
        $mytime = Carbon::now();
        $timestamp=$mytime->toDateTimeString();
        $chat->deleted_at = $timestamp;
        $chat->save();

        if($chat->id){
            Session::flash('success', 'Chat Deleted Successfully !');
            return  redirect()->back();
        }else{
            Session::flash('error', 'Something went wrong!!');
            return  redirect()->back();
        }
    
    }


}
