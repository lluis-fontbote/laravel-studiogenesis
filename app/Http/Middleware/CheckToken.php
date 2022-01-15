<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (isset($request->token)) {
            try {
                $token = $request->token;
                JWTAuth::parseToken()->authenticate();
                return $next($request);

            } catch (JWTException $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    $message = 'Token inválido';
                                
                } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    $message = 'El token ha expirado';

                } else {
                    $message = 'No se pudo validar su token';
                }

                return response()->json([
                    'message' => $message,
                ], 401);
            }

        } else {
            return response()->json([
                'message' => 'Hay que proporcionar token para acceder a este recurso'
            ], 401);
        }

    }
}
