<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestsManageController extends Controller
{
    private function getBaseUrl()
    {
        return config('services.backend.url');
    }

    private function getToken()
    {
        return session('api_token');
    }

    /**
     * Display manage tests page (for admins to assign tests)
     */
    public function index()
    {
        $role = session('user_role');
        
        // Only admins can access this page
        if (!in_array($role, ['school_admin', 'company_admin'])) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized access');
        }

        return view('dashboard.manage-tests', ['role' => $role]);
    }

    /**
     * Get all purchased packages for the admin
     */
    public function getPurchasedPackages()
    {
        $response = Http::withToken($this->getToken())
            ->get($this->getBaseUrl() . '/admin/purchased-packages');

        return response()->json($response->json());
    }

    /**
     * Get assignable users (students/employees) for the admin
     */
    public function getAssignableUsers(Request $request)
    {
        $url = $this->getBaseUrl() . '/admin/assignable-users';
        
        // If subscription_id is provided, append it as query parameter
        if ($request->has('subscription_id')) {
            $url .= '?subscription_id=' . $request->subscription_id;
        }
        
        $response = Http::withToken($this->getToken())
            ->get($url);

        return response()->json($response->json());
    }

    /**
     * Assign test to users (admin only)
     */
    public function assignTest(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|integer',
            'test_slug' => 'required|string',
            'user_ids' => 'required|array',
            'user_ids.*' => 'integer'
        ]);

        $response = Http::withToken($this->getToken())
            ->post($this->getBaseUrl() . '/admin/assign-test', [
                'subscription_id' => $request->subscription_id,
                'test_slug' => $request->test_slug,
                'user_ids' => $request->user_ids
            ]);

        return response()->json($response->json());
    }

    /**
     * Self-assign test (for individual users)
     * NOTE: Not needed if using automatic assignment on payment
     * Keeping this method for future flexibility if manual assignment is required
     */
    public function selfAssignTest(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|integer',
            'test_slug' => 'required|string'
        ]);

        $response = Http::withToken($this->getToken())
            ->post($this->getBaseUrl() . '/user/self-assign-test', [
                'subscription_id' => $request->subscription_id,
                'test_slug' => $request->test_slug
            ]);

        return response()->json($response->json());
    }

    /**
     * Display my tests page (for all users to see their assigned tests)
     */
    public function myTests()
    {
        $role = session('user_role');
        
        // Fetch assigned tests from backend
        $response = Http::withToken($this->getToken())
            ->get($this->getBaseUrl() . '/user/my-tests');

        $tests = [];
        if ($response->successful()) {
            $apiResponse = $response->json();
            if (isset($apiResponse['data'])) {
                $tests = $apiResponse['data'];
            }
        }

        return view('dashboard.my-tests', [
            'role' => $role,
            'tests' => $tests
        ]);
    }

    /**
     * Validate test access before taking test
     */
    public function validateTestAccess($slug)
    {
        $response = Http::withToken($this->getToken())
            ->get($this->getBaseUrl() . "/psychometric/{$slug}/validate-access");

        return response()->json($response->json());
    }

    /**
     * Get subscription statistics (for admin dashboard)
     */
    public function getSubscriptionStats()
    {
        $response = Http::withToken($this->getToken())
            ->get($this->getBaseUrl() . '/admin/subscription-stats');

        return response()->json($response->json());
    }
}
