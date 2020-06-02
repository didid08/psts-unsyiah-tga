<?php

namespace App\Http\Middleware;

use Closure;

class PreventGuest
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
        if (session('auth')['category'] == 'tamu') {
            return abort(404);
        }
        return $next($request);
    }
}
