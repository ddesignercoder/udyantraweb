<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AuthController extends Controller
{
    public function index()
    {  
        if(session('api_token')) {
            
            return view('pages.home',['isLoggedIn' => true]);
            // return redirect()->route('welcome');
        }
        return view('pages.home');
    }

    public function login(Request $request)
    {
        $baseUrl = config('services.backend.url');
        
        $response = Http::post("{$baseUrl}/login", [
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $data = $response->json();
        
        // Original Logic
        if (isset($data['status']) && $data['status'] === true) {
            session([
                'api_token' => $data['token'],
                'user_id' => $data['user']['id'],
                'user_name' => $data['user']['name'],
                'user_email' => $data['user']['email'],
            ]);
            return redirect()->route('welcome')->with('success', 'Login successful!');
        }

        return back()->with('error', 'Login failed: ' . ($data['message'] ?? 'Unknown error'));
    }

    public function register(Request $request)
    {
        $baseUrl = config('services.backend.url');

        $response = Http::post("{$baseUrl}/register", [
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        $data = $response->json();

        // Success Case (201 Created)
        if ($response->successful() && isset($data['status']) && $data['status'] === true) {
            
            session([
                'api_token' => $data['token'],
                'user_id' => $data['user']['id'],
                'user_name' => $data['user']['name'],
                'user_email' => $data['user']['email'],
            ]);

            return redirect()->route('welcome')->with('success', 'Registration successful! You are now logged in.');
        }

        // Error Case (422 Validation Error or Server Error)
        // Use ->withInput() so the Name and Email stay in the box
        return back()
            ->withInput($request->except('password')) 
            ->with('error', ($data['message']));
    }

    public function logout()
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        if ($token) {

            try {
                Http::withToken($token)->post("{$baseUrl}/logout");
            } catch (\Exception $e) {

            }
        }

        //Clear local session
        session()->forget(['api_token', 'user_id', 'user_name', 'user_email']);
        return redirect()->route('home')->with('success', 'Logged out successfully.');
    }
}


