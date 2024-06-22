<?php

namespace App\Http;

use Illuminate\Foundation\Configuration\Middleware;

class AppMiddleware
{
    public function __invoke(Middleware $middleware)
    {
        $middleware->alias([
            'jwtChecking' => \App\Http\Middleware\JwtChecking::class,
        ]);
    }
}
