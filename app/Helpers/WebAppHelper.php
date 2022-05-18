<?php
namespace App\Helper;
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

        $log_member = Session::get('Log_ID');

        $member = User::where('users.deleted_at', null)
        ->join('students', 'users.id', '=', 'students.user_id')
        ->join('schools', 'students.school_id', '=', 'schools.id')
        ->select('students.*', 'schools.name as school_name', 'users.role','users.avatar')
        ->where('users.id', '=' , $log_member)
        ->first();

    if(isset($member)){
       
        return $member;
    }
        return '';
    }
  
}