<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FSDKUserMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('fsdk_user_logged_in')) {
            return redirect()->route('user.login');
        }

        return $next($request);
    }
}