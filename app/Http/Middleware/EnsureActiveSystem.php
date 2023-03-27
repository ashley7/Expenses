<?php

namespace App\Http\Middleware;

use App\User;
use Closure;

class EnsureActiveSystem
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $appearance = User::apearance();

        $status = $appearance['status'];

        if(empty($status))
    
            return response(view('licence.licence_key')->with('status','Your system is not activated'));

        elseif($status=="invalid")
        
            return response(view('licence.licence_key')->with('status','Invalid Key'));

        elseif($status=="past")
            
            return response(view('licence.licence_key')->with('status','You Licence key expired on '.$appearance['date']));

        elseif($status=="invalids")

            return $next($request);
    }
}
