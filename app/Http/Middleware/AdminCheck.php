<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token_c = $request->bearerToken();
        $token = \App\Models\RefreshToken::where('token', $token_c)->first();

        if(!$token)
            return response()->json([
                    'error' => 'Unauthorized',
                ], 401);

        if($token?->user->is_admin)
            return $next($request);

        return response()->json([
            'error' => 'Forbidden',
        ], 403);
    }
}
