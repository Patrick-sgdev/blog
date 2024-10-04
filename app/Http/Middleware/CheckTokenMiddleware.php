<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UserToken;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckTokenMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $userToken = UserToken::where('token', $request->bearerToken())->first();
        if($userToken) {
            Auth::loginUsingId($userToken->user->id);
        }

        if(!$userToken && $request->token) {
            $userToken = UserToken::where('token', operator: $request->token)->first();
            if($userToken) {
                Auth::loginUsingId($userToken->user->id);
            }
        }

        return $next($request);
    }
}
