<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {   
        // Optional: Redirect if already logged in
        if(session('api_token')) {
            return redirect()->route('user.dashboard');
        }
        return view('pages.home');
    }

    // ==========================================
    // 1. SHOW VIEWS
    // ==========================================
    public function showSelection() {
        return view('auth.register-selection');
    }

    public function showOrgRegister() {
        return view('auth.register-org');
    }

    public function showIndividualRegister() {
        return view('auth.register-individual');
    }

    // ==========================================
    // 2. LOGIN (Updated)
    // ==========================================
    public function login(Request $request)
    {
        $baseUrl = config('services.backend.url');
        
        $response = Http::post("{$baseUrl}/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $data = $response->json();
        
        if ($response->successful() && isset($data['status']) && $data['status'] === true) {
            
            // Store extended data in session
            session([
                'api_token'       => $data['token'],
                'user_id'         => $data['user']['id'],
                'user_name'       => $data['user']['name'],
                'user_email'      => $data['user']['email'],
                // Safe fallbacks for roles
                'user_role'       => $data['user']['roles'][0] ?? 'individual', 
                'organization_id' => $data['user']['organization_id'] ?? null,
            ]);

            // ✅ CHANGED: Redirect to the new Dashboard
            return redirect()->route('user.dashboard')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Login failed: ' . ($data['message'] ?? 'Invalid Credentials'));
    }

    // ==========================================
    // 3. REGISTER ORGANIZATION (School/Company)
    // ==========================================
    public function registerOrganization(Request $request)
    {
        $baseUrl = config('services.backend.url');

        // We send ALL request data because the Blade Form field names 
        // match the API expectation (org_name, type, etc.)
        $response = Http::post("{$baseUrl}/register/organization", $request->all());

        $data = $response->json();

        if ($response->successful() && isset($data['status']) && $data['status'] === true) {
            
            session([
                'api_token'       => $data['token'],
                'user_id'         => $data['user']['id'],
                'user_name'       => $data['user']['name'],
                'user_email'      => $data['user']['email'],
                'user_role'       => $data['role'], // e.g., 'school_admin'
                'organization_id' => $data['organization_id'],
            ]);

            // ✅ CHANGED: Redirect to the new Dashboard
            return redirect()->route('user.dashboard')->with('success', 'Organization Registered Successfully!');
        }

        return back()
            ->withInput($request->except(['password', 'password_confirmation']))
            ->with('error', $data['message'] ?? 'Registration failed');
    }

    // ==========================================
    // 4. REGISTER INDIVIDUAL
    // ==========================================
    public function registerIndividual(Request $request)
    {
        $baseUrl = config('services.backend.url');

        $response = Http::post("{$baseUrl}/register/individual", [
            'name'                  => $request->name,
            'email'                 => $request->email,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        $data = $response->json();

        if ($response->successful() && isset($data['status']) && $data['status'] === true) {
            
            session([
                'api_token'  => $data['token'],
                'user_id'    => $data['user']['id'],
                'user_name'  => $data['user']['name'],
                'user_email' => $data['user']['email'],
                'user_role'  => 'individual',
            ]);

            // ✅ CHANGED: Redirect to the new Dashboard
            return redirect()->route('user.dashboard')->with('success', 'Account Created Successfully!');
        }

        return back()
            ->withInput($request->except(['password', 'password_confirmation']))
            ->with('error', $data['message'] ?? 'Registration failed');
    }

    // ==========================================
    // 5. LOGOUT
    // ==========================================
    public function logout()
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        if ($token) {
            try {
                Http::withToken($token)->post("{$baseUrl}/logout");
            } catch (\Exception $e) {
                // Ignore API errors during logout
            }
        }

        session()->flush();
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}