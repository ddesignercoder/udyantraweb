<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {   
        // Optional: Redirect if already logged in
        // if(session('api_token')) {
        //     return redirect()->route('user.dashboard');
        // }
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
                'udyantra_id'     => $data['user']['udyantra_id'] ?? null,
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
                'udyantra_id'     => $data['user']['udyantra_id'] ?? null,
            ]);

            // ✅ CHANGED: Redirect to the new Dashboard
            return redirect()->route('user.dashboard')->with('success', 'Organization Registered Successfully!');
        }

        return back()
            ->withInput($request->except(['password', 'password_confirmation']))
            ->with('error', $data['message'] ?? 'Registration failed');
    }

    // ==========================================
    // 4a. REGISTER INDIVIDUAL
    // ==========================================
    public function registerIndividual(Request $request)
    {
        $baseUrl = config('services.backend.url');

        $response = Http::post("{$baseUrl}/register/individual", [
            'name'                  => $request->name,
            'email'                 => $request->email,
            'phone'                 => $request->phone,
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
                'udyantra_id'     => $data['user']['udyantra_id'] ?? null,
            ]);

            // ✅ CHANGED: Redirect to the new Dashboard
            return redirect()->route('user.dashboard')->with('success', 'Account Created Successfully!');
        }

        return back()
            ->withInput($request->except(['password', 'password_confirmation']))
            ->with('error', $data['message'] ?? 'Registration failed');
    }

    // ==========================================
    // 4b. MEMBER REGISTER (Student / Employee)
    // ==========================================
    public function showMemberRegister(Request $request, $inviteCode)
    {
        $baseUrl = config('services.backend.url');
        
        $organization = null;
        $orgId = null;
        $formTag = null;

        try {
            // Get invitation details by hash key
            $response = Http::get("{$baseUrl}/invitations/{$inviteCode}");
            if ($response->successful()) {
                $data = $response->json()['data'];
                $organization = $data['organization'];
                $orgId = $data['organization_id'];
                $formTag = $data['form_tag'];
            }
        } catch (\Exception $e) {
            return redirect()->route('login')->with('error', 'Invalid invitation link.');
        }

        if (!$organization) {
            return redirect()->route('login')->with('error', 'Invalid invitation link.');
        }

        return view('auth.register-member', compact('organization', 'orgId', 'formTag'));
    }

    public function registerMember(Request $request)
    {
        $baseUrl = config('services.backend.url');

        // Forward the registration form data to backend
        $response = Http::post("{$baseUrl}/register/member", $request->all());
        $data = $response->json();

        if ($response->successful() && isset($data['status']) && $data['status'] === true) {
            
            session([
                'api_token'       => $data['token'],
                'user_id'         => $data['user']['id'],
                'user_name'       => $data['user']['name'],
                'user_email'      => $data['user']['email'],
                'user_role'       => $data['user']['roles'][0] ?? 'student',
                'organization_id' => $data['user']['organization_id'] ?? null,
                'udyantra_id'     => $data['user']['udyantra_id'] ?? null,
            ]);

            // If auto-assigned, redirect to the test-panel
            if (!empty($data['auto_assigned']) && !empty($data['test_slug'])) {
                return redirect()->route('test-panel', ['slug' => $data['test_slug']])
                    ->with('success', 'Registration successful! You have been auto-assigned a test.');
            }

            // Redirect to dashboard
            return redirect()->route('user.dashboard')
                ->with('success', 'Registration successful! Please contact your administrator to assign tests.');
        }

        // if ($response->status() === 422) {
        //     return back()
        //         ->withInput($request->except(['password', 'password_confirmation']))
        //         ->withErrors($data['errors'] ?? [])
        //         ->with('error', $data['message'] ?? 'Validation failed.');
        // }

        return back()
            ->withInput($request->except(['password', 'password_confirmation']))
            ->with('error', $data['message'] ?? 'Registration failed.');
    }

    // ==========================================
    // 5. FORGOT PASSWORD
    // ==========================================
    public function forgotPassword(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $baseUrl  = config('services.backend.url');
        $response = Http::post("{$baseUrl}/forgot-password", [
            'email' => $request->email,
        ]);

        $data = $response->json();

        return response()->json($data, $response->status());
    }

    // ==========================================
    // 6. RESET PASSWORD
    // ==========================================
    public function resetPassword(Request $request)
    {
        $request->validate([
            'email'                 => 'required|email',
            'token'                 => 'required|string',
            'password'              => 'required|string|min:8',
            'password_confirmation' => 'required|string|same:password',
        ]);

        $baseUrl  = config('services.backend.url');
        $response = Http::post("{$baseUrl}/reset-password", [
            'email'                 => $request->email,
            'token'                 => $request->token,
            'password'              => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ]);

        $data = $response->json();

        return response()->json($data, $response->status());
    }

    // ==========================================
    // 7. LOGOUT
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