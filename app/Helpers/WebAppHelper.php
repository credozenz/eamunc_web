<?php
namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Intervention\Image\Facades\Image;
use App\Models\School;
use App\Models\Students;
use App\Models\Countries;
use App\Models\Committee;
use App\Models\User;
class WebAppHelper
{


    function getLogMember() {
        $log_role = Session::get('Log_ROLE');
        $log_member = Session::get('Log_ID');
        
        if($log_role == 4){
            $log_committee = Session::get('Committee_ID');
            $member = User::where('users.deleted_at', null)
            ->select('users.*')
            ->where('users.id', '=' , $log_member)
            ->first();
            
            $member->committee_choice = $log_committee ?? '';
            
        }else{

            $member = User::where('users.deleted_at', null)
            ->join('students', 'users.id', '=', 'students.user_id')
            ->leftjoin('schools', 'students.school_id', '=', 'schools.id')
            ->select('students.*', 'schools.name as school_name', 'users.role','users.avatar')
            ->where('users.id', '=' , $log_member)
            ->first();

        }
       

    if(isset($member)){
       
        return $member;
    }
        return '';
    }
  
}