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
                $token = \App\Models\Access_Token::where('token', $token_c)->first();

                if ($token)
                    if ($token->user->name) {
                        if(now()->greaterThan($token->expired_at)) {
                            return \response()->json(['message' => 'Token expired'], Response::HTTP_UNAUTHORIZED);
                        }else{
                            return $next($request);
                        }
                    }
            }

        return response()->json([
            'error' => 'token not found',
        ], 401);
    }
}
