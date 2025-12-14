<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use App\Http\Middleware\AdminMiddleware;

class Kernel extends HttpKernel
{
    protected $middleware = []; // no global middleware

    protected $middlewareGroups = [
        'web' => [],
        'api' => [],
    ];

    protected $routeMiddleware = [
        'admin' => AdminMiddleware::class,
        // standard auth middleware so controllers can use $this->middleware('auth')
        'auth' => \Illuminate\Auth\Middleware\Authenticate::class,
    ];
}

