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
            'user_ids.*' => 'integer',
            'can_view_report' => 'sometimes|boolean'
        ]);

        $response = Http::withToken($this->getToken())
            ->post($this->getBaseUrl() . '/admin/assign-test', [
                'subscription_id' => $request->subscription_id,
                'test_slug' => $request->test_slug,
                'user_ids' => $request->user_ids,
                'can_view_report' => $request->boolean('can_view_report', true)
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

    /**
     * Toggle report viewing permission for a test assignment (admin only)
     */
    public function toggleReportPermission(Request $request)
    {
        $request->validate([
            'assignment_id' => 'required|integer',
            'can_view_report' => 'required|boolean'
        ]);

        $response = Http::withToken($this->getToken())
            ->patch($this->getBaseUrl() . '/admin/toggle-report-permission', [
                'assignment_id' => $request->assignment_id,
                'can_view_report' => $request->boolean('can_view_report')
            ]);

        return response()->json($response->json());
    }

    /**
     * Display manage report permissions page (for admins)
     */
    public function manageReportPermissions()
    {
        $role = session('user_role');

        if (!in_array($role, ['school_admin', 'company_admin'])) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized access');
        }

        return view('dashboard.manage-report-permissions', ['role' => $role]);
    }

    /**
     * Get users with their test history for report permission management
     */
    public function getUsersWithTestHistory(Request $request)
    {
        $request->validate([
            'subscription_id' => 'required|integer',
        ]);

        $subscriptionId = $request->subscription_id;

        // Step 1: Get users assigned to this specific package
        $usersResponse = Http::withToken($this->getToken())
            ->get($this->getBaseUrl() . '/admin/assignable-users', [
                'subscription_id' => $subscriptionId
            ]);

        if (!$usersResponse->successful() || !$usersResponse->json('status')) {
            return response()->json(['status' => false, 'message' => 'Failed to fetch users']);
        }

        $users = $usersResponse->json('data');

        // Step 2: For users who have been assigned this package's test, get their test history
        $usersWithHistory = [];
        foreach ($users as $user) {
            // Only fetch history for users who have been assigned this test
            if (!isset($user['test_assigned']) || !$user['test_assigned']) {
                continue;
            }

            $historyResponse = Http::withToken($this->getToken())
                ->get($this->getBaseUrl() . '/user-test-history', [
                    'user_id' => $user['id']
                ]);

            $history = [];
            if ($historyResponse->successful()) {
                $historyData = $historyResponse->json();
                $history = $historyData['history'] ?? [];
            }

            $user['test_history'] = $history;
            $usersWithHistory[] = $user;
        }

        return response()->json([
            'status' => true,
            'data' => $usersWithHistory
        ]);
    }
}
