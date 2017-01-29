<?php

namespace Snaketec\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

/**
 * Class Kernel.
 */
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
        \Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array
     */
    protected $middlewareGroups = [
        'web' => [
            \Snaketec\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Snaketec\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Snaketec\Http\Middleware\LocaleMiddleware::class,
        ],

        'admin' => [
            'auth',
            'access.routeNeedsPermission:view-backend',
            'timeout',
        ],

        'api' => [
            'throttle:60,1',
            'bindings',
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
        'auth'       => \Illuminate\Auth\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'bindings'   => \Illuminate\Routing\Middleware\SubstituteBindings::class,
        'can'        => \Illuminate\Auth\Middleware\Authorize::class,
        'guest'      => \Snaketec\Http\Middleware\RedirectIfAuthenticated::class,
        'throttle'   => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'timeout'    => \Snaketec\Http\Middleware\SessionTimeout::class,

        /*
         * Access Middleware
         */
        'access.routeNeedsRole'       => \Snaketec\Http\Middleware\RouteNeedsRole::class,
        'access.routeNeedsPermission' => \Snaketec\Http\Middleware\RouteNeedsPermission::class,
    ];
}
