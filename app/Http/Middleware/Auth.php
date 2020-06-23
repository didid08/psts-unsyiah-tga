<?php

namespace App\Http\Middleware;

use Closure;

class Auth
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
        if ($request->is('auth/login') | $request->is('auth/login/*')) {
            if (session('auth')) {
                return redirect('/');
            }
            return $next($request);
        }else {
            if (session('auth')) {
                return $next($request);
            }
            return redirect('auth/login');
        }
    }
}
