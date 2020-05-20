<?php

namespace App\Http\Middleware;

use Closure;

class ResetSessionConfig
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
        config([
            'session.lifetime' => 15,
            'session.expire_on_close' => true
        ]);
        return $next($request);
    }
}
