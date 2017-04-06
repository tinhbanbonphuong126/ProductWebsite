<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            $user = \Auth::user();
            if($user->role == 1){
                // link to admin
                return \Redirect::to('/admin/users');
            }else{
                // return link for user
                return \Redirect::to('/staff/staffrequest');
            }
            //return redirect('/');
        }

        return $next($request);
    }
}
