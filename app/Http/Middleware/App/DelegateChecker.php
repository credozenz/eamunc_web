<?php

namespace App\Http\Middleware\App;
use Session;
use Closure;
use Illuminate\Http\Request;

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
                return $next($request); 
            }
            
        }
        else
        {
            return redirect('/app');          
        }
 
    }
}
