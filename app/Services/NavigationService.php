<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class NavigationService
{
    public function getMenu()
    {
        // 1. Get Token & User ID from Session (Saved during Login)
        $token = Session::get('api_token');
        $userId = Session::get('user_id');

        // If no token, return empty menu (User is guest)
        if (!$token) {
            return [];
        }

        // 2. Cache the menu for 60 minutes to improve speed
        // The cache key is unique per user: "nav_menu_1", "nav_menu_2", etc.
        return Cache::remember("nav_menu_{$userId}", 60 * 60, function () use ($token) {
            
            $baseUrl = config('services.backend.url'); 

            try {
                $response = Http::withToken($token)
                    ->timeout(10) 
                    ->get("{$baseUrl}/navigation");

                if ($response->successful()) {
                    return $response->json()['data'];
                }
            } catch (\Exception $e) {
                return []; 
            }

            return [];
        });
    }
}