<?php

namespace App\Http\Middleware;

use Closure;
use App\User;
use App\AdministrasiTGA as Adm;

class AdministrasiTGA
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
        $nim = $request->route('nim');
        $progress = $request->route('progress');

        $mhs = User::where(['nomor_induk' => $nim, 'category' => 'mahasiswa']);
        if ($mhs->exists()) {

            $adm = Adm::where('user_id', $mhs->first()->id);
            if ($adm->exists()) {

                if (strpos($progress, 'ptional')) {
                    if ((int)explode('-', $progress)[1] == $adm->first()->progress_optional) {
                        return $next($request);
                    }
                    return 'd';
                }
                elseif ((int)$progress == $adm->first()->progress) {
                    return $next($request);
                }
                return 'c';

            }
            return 'b';

        }
        return 'a';
    }
}
