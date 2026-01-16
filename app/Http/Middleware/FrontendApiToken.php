<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Response;

class FrontendApiToken
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = session('api_token');

        // ❌ No token in session
        if (!$token) {
            return redirect()->route('home')
                ->with('error', 'Login to continue.');
        }

        try {
            // 🔍 Validate token via backend
            $response = Http::timeout(10)
                ->withToken($token)
                ->get(config('services.backend.url') . '/user');
        } catch (\Throwable $e) {
            // Backend unreachable → force logout
            Session::forget('api_token');

            return redirect()->route('home')
                ->with('error', 'Login to continue.');
        }

        // ❌ Expired / deleted / invalid token
        if ($response->status() === 401) {
            Session::forget('api_token');

            return redirect()->route('home')
                ->with('error', 'Your session has expired. Please login again.');
        }

        return $next($request);
    }
}