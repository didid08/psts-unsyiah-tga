<?php

namespace App\Http\Middleware\TGA;

use Closure;
use App\UserRole;

class OnlyMahasiswa
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
        $role = new UserRole->myRoles();
        if (isset($role->mhs))
            return $next($request);
        }
        return abort(404);
    }
}
