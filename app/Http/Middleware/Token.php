<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //get token
            $token_c = $request->bearerToken();

            if($token_c) {
                $token = \App\Models\RefreshToken::where('token', $token_c)->first();

                if ($token)
                    if ($token->user->name && $token->expire_time > Carbon::now()->toDateTimeString()) {
                        return $next($request);
                    }
            }

        return response()->json([
            'error' => 'RefreshToken is required.',
        ], 401);
    }
}
