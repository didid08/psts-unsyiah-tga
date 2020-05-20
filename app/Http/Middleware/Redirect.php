<?php

namespace App\Http\Middleware;

use Closure;

class Redirect
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
        if (explode('/', $request->path())[0] != session('auth')['category']) {
            return abort(404);
        }
        return $next($request);
    }
}
