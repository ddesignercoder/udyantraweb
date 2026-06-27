<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class InviteMemberController extends Controller
{
    public function inviteMembers(Request $request) //For student or employee invite to self register
    {
        $role = session('user_role');
        $token = session('api_token');
        $baseUrl = config('services.backend.url');
        
        // Safety Check: Only Admins can access this
        if (!in_array($role, ['school_admin', 'company_admin'])) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized access');
        }

        $invitations = null;
        try {
            $response = Http::withToken($token)->get("{$baseUrl}/invitations", [
                'per_page' => 10,
                'page'     => $request->input('page', 1)
            ]);
            if ($response->successful()) {
                $responseData = $response->json();
                $data = $responseData['data'] ?? [];
                
                $invitations = new \Illuminate\Pagination\LengthAwarePaginator(
                    $data['data'] ?? [],
                    $data['total'] ?? 0,
                    $data['per_page'] ?? 10,
                    $data['current_page'] ?? 1,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }
        } catch (\Exception $e) {
            // Silently ignore
        }

        return view('dashboard.invite-members', [
            'role' => $role,
            'invitations' => $invitations
        ]);
    }

    public function generateInviteLink(Request $request)
    {
        $role = session('user_role');
        $token = session('api_token');
        $baseUrl = config('services.backend.url');

        // Check if Admin
        if (!in_array($role, ['school_admin', 'company_admin'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        // Call the backend API
        $response = Http::withToken($token)->post("{$baseUrl}/invitations", [
            'organization_id' => session('organization_id'),
            'form_tag'        => $request->input('form_tag')
        ]);

        $data = $response->json();

        return response()->json($data, $response->status());
    }

    public function toggleInviteStatus($id)
    {
        $role = session('user_role');
        $token = session('api_token');
        $baseUrl = config('services.backend.url');

        // Check if Admin
        if (!in_array($role, ['school_admin', 'company_admin'])) {
            return response()->json([
                'status'  => false,
                'message' => 'Unauthorized access.'
            ], 403);
        }

        // Call the backend API
        $response = Http::withToken($token)->patch("{$baseUrl}/invitations/{$id}/toggle-status");

        $data = $response->json();

        return response()->json($data, $response->status());
    }

    public function registeredUsers(Request $request)
    {
        $role = session('user_role');
        $token = session('api_token');
        $baseUrl = config('services.backend.url');
        $formTag = $request->query('form_tag');

        if (!$formTag) {
            return redirect()->route('dashboard.invite-members')->with('error', 'Form Tag is required.');
        }

        // Call the same backend API to fetch users filtered by form_tag
        $endpoint = ($role === 'school_admin') ? '/school/students' : '/company/employees';
        
        $users = null;
        try {
            $response = Http::withToken($token)->get("{$baseUrl}{$endpoint}", [
                'form_tag' => $formTag,
                'per_page' => 10,
                'page'     => $request->input('page', 1)
            ]);

            if ($response->successful()) {
                $responseData = $response->json();
                $data = $responseData['data'] ?? [];
                
                // Construct Laravel LengthAwarePaginator to support pagination links in frontend
                $users = new \Illuminate\Pagination\LengthAwarePaginator(
                    $data['data'] ?? [],
                    $data['total'] ?? 0,
                    $data['per_page'] ?? 10,
                    $data['current_page'] ?? 1,
                    ['path' => $request->url(), 'query' => $request->query()]
                );
            }
        } catch (\Exception $e) {
            // Handle exception
        }

        return view('dashboard.invite-users-list', [
            'role'      => $role,
            'formTag'   => $formTag,
            'users'     => $users
        ]);
    }
}
