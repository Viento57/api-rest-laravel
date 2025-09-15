<?php

namespace App\Http\Middleware;

use Closure;
use symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class JwtMiddleware
{
  public function handle($request, Closure $next)
  {
    try {
      JWTAuth::parseToken()->authenticate();
    } catch (\Exception $e) {
      return response()->json([
        'message' => 'Token invalido o no proporcionado',
        'statusCode' => Response::HTTP_UNAUTHORIZED
      ], Response::HTTP_UNAUTHORIZED);
    }

    return $next($request);
  }
}
