<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Daftarkan alias middleware custom di sini (Laravel 12)
        $middleware->alias([
            'owner' => \App\Http\Middleware\IsOwner::class,
        ]);
    })
    ->withExceptions(function ($exceptions) {
        //
    })
    ->create();
