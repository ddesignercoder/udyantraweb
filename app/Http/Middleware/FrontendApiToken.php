<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FrontendApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Check if the token exists in the session
        if (!session()->has('api_token')) {
            
            // 2. If not, redirect to Login page with a message
            return redirect()->route('home')->with('error', 'You must be logged in to access this page.');
        }

        // 3. If yes, let them pass
        return $next($request);
    }
}