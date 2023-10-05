<?php

namespace App\Http\Middleware;
use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\DB;
class ApiTokenValidation
{
    public function handle($request, Closure $next)
    {

        $token =$request->bearerToken();
        [$id, $user_token] = explode('|', $token, 2);
        $user_token = hash('sha256', $user_token);

        $token_data = DB::table('personal_access_tokens')->where('token', $user_token)->first();
        $user_id = $token_data->tokenable_id ?? '';
        
        if (isset($user_id) && !empty($user_id)) {
            Auth::loginUsingId($user_id);
            return $next($request);
        }else{
            return response()->json(['message' => 'Unauthorized Access'], 401);
        }
    }




}

?>
