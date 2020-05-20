<?php

namespace App\Http\Middleware;

use Closure;

class RememberUserLogin
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
        if (!session('auth') && $request->isMethod('post') && $request->path() == '/login') {
            config([
                'session.lifetime' => 720,
                'session.expire_on_close' => false
            ]);
        }
        return $next($request);
    }
}
