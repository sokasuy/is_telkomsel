<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
// use App\Http\Middleware\EnsureUserHasAccess;
// use App\Http\Middleware\AuthenticationUser;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
        // $middleware->append(AuthenticationUser::class);
        $middleware->appendToGroup('EnsureAuthenticationAccess', [
            App\Http\Middleware\EnsureAuthenticationAccess::class
        ]);
        // $middleware->appendToGroup('MenuAutentikasiUser', [
        //     AuthenticationUser::class
        //     // Second::class,
        // ]);

        // $middleware->alias([
        //     'MenuAutentikasiAkses' => App\Http\Middleware\EnsureUserHasAccess::class
        // ]);
        $middleware->alias([
            'EnsureUserHasPermission' => App\Http\Middleware\EnsureUserHasPermission::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
