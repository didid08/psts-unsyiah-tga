<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array
     */
    protected $middleware = [
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\CheckForMaintenanceMode::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            'throttle:60,1',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array
     */
    protected $routeMiddleware = [
        'administrasi-tga' => \App\Http\Middleware\AdministrasiTGA::class,
        'auth' => \App\Http\Middleware\Auth::class,
        'bindings' => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,

        'only.admin' => \App\Http\Middleware\OnlyAdmin::class,
        'only.ketua-kel-keahlian' => \App\Http\Middleware\OnlyKetuaKelKeahlian::class,
        'only.koor-prodi' => \App\Http\Middleware\OnlyKoorProdi::class,
        'only.koor-tga' => \App\Http\Middleware\OnlyKoorTGA::class,
        'only.pembimbing-co' => \App\Http\Middleware\OnlyPembimbingCo::class,
        'only.komisi-penguji' => \App\Http\Middleware\OnlyKomisiPenguji::class,
        'only.mahasiswa' => \App\Http\Middleware\OnlyMahasiswa::class,

        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'prevent.guest' => \App\Http\Middleware\PreventGuest::class,
        'redirect' => \App\Http\Middleware\Redirect::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class
    ];
}
