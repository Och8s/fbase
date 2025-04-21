<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsEntrenador
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user && $user->rol === 'entrenador') {
            return $next($request);
        }

        return response()->json(['error' => 'Accés no autoritzat'], 403);
    }
}

