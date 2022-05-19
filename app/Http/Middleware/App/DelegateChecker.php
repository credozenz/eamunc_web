<?php

namespace App\Http\Middleware\App;
use Session;
use Closure;
use Illuminate\Http\Request;
use App\Models\User;
use View;

class DelegateChecker
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
       
       
        if(Session::has('Log_ID'))
        {
            
            if(Session::get('Log_ROLE') == '2')
            {
                $log_member = Session::get('Log_ID');

                $member = User::where('users.deleted_at', null)
                ->join('students', 'users.id', '=', 'students.user_id')
                ->join('schools', 'students.school_id', '=', 'schools.id')
                ->select('students.*', 'schools.name as school_name', 'users.role','users.avatar')
                ->where('users.id', '=' , $log_member)
                ->first();
                View::share('member', $member);
                
                return $next($request); 
            }
            
        }
        else
        {
            return redirect('/app');          
        }
 
    }
}
