<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OrgUserManagementController extends Controller
{
    public function storeUser(Request $request)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');
        $role = session('user_role');

        // 1. Determine Endpoint based on Role
        $endpoint = $role === 'school_admin' 
            ? '/school/add-student' 
            : '/company/add-employee';

        // 2. Call API
        $response = Http::withToken($token)->post($baseUrl . $endpoint, $request->all());

        // 3. Handle Response
        if ($response->successful()) {
            return back()->with('success', 'User ID created successfully!');
        }

        return back()
            ->withErrors($response->json()['errors'] ?? [])
            ->with('error', $response->json()['message'] ?? 'Failed to create user.');
    }
}