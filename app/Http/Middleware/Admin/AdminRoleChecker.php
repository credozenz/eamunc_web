<?php

namespace App\Http\Middleware\Admin;
use Session;
use Closure;
use Illuminate\Http\Request;

class AdminRoleChecker
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
       
        
        if(Session::has('ID'))
        {
          
            if(Session::get('ROLE') == '1')
            {
                return $next($request); 
            }
            
        }
        else
        {
            return redirect()->back();          
        }
    }
}
