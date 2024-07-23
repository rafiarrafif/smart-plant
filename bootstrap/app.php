<?php

use App\Http\Middleware\AuthenticateAccount;
use App\Http\Middleware\OnlyAdmin;
use App\Http\Middleware\StateApp;
use App\Http\Middleware\VisitorCount;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->trustProxies(at: '*');
        $middleware->trustProxies(headers: 
            Request::HEADER_X_FORWARDED_FOR |
            Request::HEADER_X_FORWARDED_HOST |
            Request::HEADER_X_FORWARDED_PORT |
            Request::HEADER_X_FORWARDED_PROTO |
            Request::HEADER_X_FORWARDED_AWS_ELB
        ); 

        $middleware->web(append: [
            VisitorCount::class,
            StateApp::class
        ]);

        $middleware->alias([
            'AuthenticateAcc' => AuthenticateAccount::class,
            'OnlyAdmin' => OnlyAdmin::class,
            'StateApp' => StateApp::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();