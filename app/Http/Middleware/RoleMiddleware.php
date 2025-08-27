<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$role): Response
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();
        } catch (\Exception $e) {
            return response()->json(['error' => 'Token invalido o no valido'], 401);
        }


        // if($user->role !== $role){
        //     return response()->json(['error' => 'Acceso denegado. No tienes el permiso necesario'], 403);
        // }

        //Para arrray de roles
        // if(!in_array($user->role, $role)){
        //     return response()->json(['error' => 'Acceso denegado. No tienes el permiso necesario'], 403);
        // }

        // if (! in_array($user->role, $roles, true)) {
        //     return response()->json(['error' => 'Acceso denegado. No tienes el permiso necesario'], 403);
        // }

        if (! in_array($user->role, $role, true)) {
            return response()->json(['error' => 'Acceso denegado. No tienes el permiso necesario'], 403);
        }


        return $next($request);
    }
}
