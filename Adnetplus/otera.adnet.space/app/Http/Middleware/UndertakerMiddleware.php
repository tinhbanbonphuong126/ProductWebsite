<?php

namespace App\Http\Middleware;

use Closure;

class UndertakerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = 'undertaker')
    {
        if (!\Auth::guard($guard)->check()) {
            return redirect()->guest('auth/login');
        }

        return $next($request);
    }
}
