<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

use App\Http\Middleware\IsEntrenador;
use App\Http\Middleware\IsTutor;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Activa el suport per a peticions d'API amb estat
        $middleware->statefulApi();

        // Defineix els àlies per als teus middleware personalitzats
        $middleware->alias([
            'isEntrenador' => IsEntrenador::class,
            'isTutor' => IsTutor::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
