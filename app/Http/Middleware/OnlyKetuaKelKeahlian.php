<?php

namespace App\Http\Middleware;

use Closure;
use App\UserRole;

class OnlyKetuaKelKeahlian
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
        $userRole = new UserRole();
        $role = $userRole->myRoles();

        if (isset($role->ketua_kel_keahlian)) {
            return $next($request);
        }
        return abort(404);
    }
}
