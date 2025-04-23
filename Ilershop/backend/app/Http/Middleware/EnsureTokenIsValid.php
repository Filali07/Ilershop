<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureTokenIsValid
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->bearerToken()) {
            return response()->json([
                'message' => 'Token de autenticación no proporcionado'
            ], 401);
        }

        // Opcional: Verificar si el token es válido con Sanctum
        if (!auth('sanctum')->check()) {
            return response()->json([
                'message' => 'Token inválido o expirado'
            ], 403);
        }

        return $next($request);
    }
}