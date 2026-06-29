<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    // ==========================================
    // 1. FETCH PROFILE (GET)
    // ==========================================
    public function edit()
    {
        $token = Session::get('api_token');
        $baseUrl = config('services.backend.url');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        try {
            $response = Http::withToken($token)->get("{$baseUrl}/profile/fetch");
            
            // Handle Session Expiry on Fetch
            if ($response->status() === 401) {
                session()->flush();
                return redirect()->route('login')->with('error', 'Session expired.');
            }

            $result = $response->json();

            if ($response->successful() && ($result['success'] ?? false)) {
                return view('settings.edit', [
                    'role' => $result['role'] ?? 'user',
                    'data' => $result['data'] ?? []
                ]);
            }
            
            return back()->with('error', $result['message'] ?? 'Unable to fetch profile data.');

        } catch (\Exception $e) {
            return back()->with('error', 'Server unreachable.');
        }
    }

    // ==========================================
    // 2. UPDATE PROFILE (POST)
    // ==========================================
    public function update(Request $request)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        try {
            $url = config('services.backend.url') . '/profile/update';
            
            // Forward Request to Backend
            $response = Http::withToken($token)->post($url, $request->all());
            $result = $response->json();

            // 1. Success
            if ($response->successful() && ($result['success'] ?? false)) {
                if ($request->has('name')) {
                    session(['user_name' => $request->name]);
                }
                // return back()->with('success', 'Profile updated successfully!');
                return redirect()->route('user.dashboard')->with('success', 'Profile updated successfully!');
            }

            // 2. Validation Error (422)
            if ($response->status() === 422) {
                return back()->with('error', $result['message'] ?? 'Validation error occurred.');
            }


            // 3. Other API Errors
            return back()->with('error', $result['message'] ?? 'Failed to update profile.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to connect to server.');
        }
    }
    
    // ==========================================
    // 3. UPDATE PASSWORD (POST)
    // ==========================================
    public function updatePassword(Request $request)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        try {
            $url = config('services.backend.url') . '/profile/password';
            
            // Forward Request to Backend
            $response = Http::withToken($token)->post($url, $request->all());
            $result = $response->json();

            // 1. Success
            if ($response->successful() && ($result['success'] ?? false)) {
                // return back()->with('success', 'Password updated successfully!');
                return redirect()->route('user.dashboard')->with('success', 'Password updated successfully!');
            }

            // 2. Validation Error (422)
            if ($response->status() === 422) {
                // We pass the errors to the 'updatePassword' bag to match your Blade component
                return back()
                    ->withErrors($result['errors'] ?? [], 'updatePassword') 
                    ->withInput();
            }

            // 3. Unauthorized
            if ($response->status() === 401) {
                session()->flush();
                return redirect()->route('login')->with('error', 'Session expired.');
            }

            return back()->with('error', $result['message'] ?? 'Failed to update password.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to connect to server.');
        }
    }

    // ==========================================
    // 4. UPDATE BRAND LOGO (POST)
    // ==========================================
    public function updateBrandLogo(Request $request)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $request->validateWithBag('updateBrandLogo', [
            'brand_logo' => 'required|image|mimes:jpg,jpeg,png,webp|max:250',
        ]);

        try {
            $url = config('services.backend.url') . '/profile/update-brand-logo';
            
            // Forward Multipart Request to Backend
            $response = Http::withToken($token)
                ->attach(
                    'brand_logo', 
                    $request->file('brand_logo')->getContent(), 
                    $request->file('brand_logo')->getClientOriginalName()
                )
                ->post($url);
                
            $result = $response->json();
           
            // 1. Success
            if ($response->successful() && ($result['success'] ?? false)) {
                return redirect()->route('profile.brand-logo')->with('success', 'Brand logo updated successfully!');
            }

            // 2. Validation Error (422)
            if ($response->status() === 422) {
                return back()
                    ->withErrors($result['errors'] ?? [], 'updateBrandLogo') 
                    ->withInput();
            }

            // 3. Unauthorized
            if ($response->status() === 401) {
                session()->flush();
                return redirect()->route('login')->with('error', 'Session expired.');
            }

            return back()->with('error', $result['message'] ?? 'Failed to update brand logo.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to connect to server.');
        }
    }

    // ==========================================
    // 5. UPDATE BRAND BACKGROUND (POST)
    // ==========================================
    public function updateBrandBackground(Request $request)
    {
        $token = Session::get('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Please log in.');
        }

        $request->validateWithBag('updateBrandBackground', [
            'brand_background' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        try {
            $url = config('services.backend.url') . '/profile/update-brand-background';
            
            // Forward Multipart Request to Backend
            $response = Http::withToken($token)
                ->attach(
                    'brand_background', 
                    $request->file('brand_background')->getContent(), 
                    $request->file('brand_background')->getClientOriginalName()
                )
                ->post($url);
                
            $result = $response->json();
           
            // 1. Success
            if ($response->successful() && ($result['success'] ?? false)) {
                return redirect()->route('profile.brand-background')->with('success', 'Brand background updated successfully!');
            }

            // 2. Validation Error (422)
            if ($response->status() === 422) {
                return back()
                    ->withErrors($result['errors'] ?? [], 'updateBrandBackground') 
                    ->withInput();
            }

            // 3. Unauthorized
            if ($response->status() === 401) {
                session()->flush();
                return redirect()->route('login')->with('error', 'Session expired.');
            }

            return back()->with('error', $result['message'] ?? 'Failed to update brand background.');

        } catch (\Exception $e) {
            return back()->with('error', 'Unable to connect to server.');
        }
    }
}