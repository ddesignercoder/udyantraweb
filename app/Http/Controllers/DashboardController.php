<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Get User Data from Session
        $role = session('user_role');
        $userName = session('user_name');
        
        // 2. Fetch Dashboard Stats (if Admin)
        $statsData = [];
        if (in_array($role, ['school_admin', 'company_admin','individual'])) {
            $token = session('api_token');
            $baseUrl = config('services.backend.url');
            
            try {
                $response = Http::withToken($token)->get($baseUrl . '/admin/dashboard-stats');
                if ($response->successful() && isset($response->json()['data'])) {
                    $statsData = $response->json()['data'];
                }
            } catch (\Exception $e) {
                // Log error or keep empty
            }
        }

        // 3. Define Dashboard Config based on Role & Data
        $dashboardConfig = $this->getRoleConfig($role, $statsData);

        return view('dashboard.index', [
            'role' => $role,
            'user_name' => $userName,
            'config' => $dashboardConfig
        ]);
    }

    private function getRoleConfig($role, $data = [])
    {
        // Helper to safely get value or default
        $val = fn($key) => $data[$key] ?? '--';

        return match ($role) {
            'school_admin' => [
                'title' => 'School Administration',
                'widgets' => [
                    ['label' => 'Total Students', 'value' => $val('total_users')],
                    ['label' => 'Packages Available', 'value' => $val('total_packages')],
                    ['label' => 'Tests Available', 'value' => $val('total_tests_available')],
                ],
                // 'color' => 'blue'
            ],
            'company_admin' => [
                'title' => 'Company Management',
                'widgets' => [
                    ['label' => 'Total Employees', 'value' => $val('total_users')],
                    ['label' => 'Packages Available', 'value' => $val('total_packages')],
                    ['label' => 'Tests Available', 'value' => $val('total_tests_available')],
                ],
                // 'color' => 'indigo'
            ],
            'student' => [
                'title' => 'Student Portal',
                'widgets' => [
                    ['label' => 'Upcoming Tests', 'value' => '--'], 
                ],
                // 'color' => 'green'
            ],
            'employee' => [
                'title' => 'Employee Portal',
                'widgets' => [
                    ['label' => 'Upcoming Tests', 'value' => '--'], 
                ],
                // 'color' => 'teal'
            ],
            'individual' => [ // 'individual'
                'title' => 'My Dashboard',
                'widgets' => [
                    ['label' => 'Packages Available', 'value' => $val('total_packages')],
                    ['label' => 'Tests Available', 'value' => $val('total_tests_available')],
                ],
                // 'color' => 'gray'
            ],
        };
    }

    public function addUser()
    {
        $role = session('user_role');
        
        // Safety Check: Only Admins can access this
        if (!in_array($role, ['school_admin', 'company_admin'])) {
            return redirect()->route('user.dashboard')->with('error', 'Unauthorized access');
        }

        return view('dashboard.add-user', ['role' => $role]);
    }

    public function listUsers(Request $request)
    {
        $role = session('user_role');
        $token = session('api_token');
        $baseUrl = config('services.backend.url');

        // 1. Determine API Endpoint
        if ($role === 'school_admin') {
            $endpoint = '/school/students';
            $pageTitle = 'Manage Students';
        } elseif ($role === 'company_admin') {
            $endpoint = '/company/employees';
            $pageTitle = 'Manage Employees';
        } else {
            return redirect()->route('user.dashboard');
        }

        // 2. Prepare Query Parameters
        // We capture 'page' and 'search' from the browser URL to send to the API
        $queryParams = [
            'page' => $request->input('page', 1),
            'per_page' => 10,                 // You can change this to 20 or 50
            'search' => $request->input('search'), // Forward the search term
        ];

        // 3. Fetch Data from API
        // The API will now receive: ?page=1&per_page=10&search=rohit
        $response = Http::withToken($token)->get($baseUrl . $endpoint, $queryParams);

        // Default empty paginator in case of error
        $usersPaginator = new LengthAwarePaginator([], 0, 10);

        if ($response->successful()) {
            $apiResponse = $response->json();
            
            // Based on your backend structure: { status: true, data: { current_page: 1, data: [...] } }
            if (isset($apiResponse['data']) && isset($apiResponse['data']['data'])) {
                $meta = $apiResponse['data']; // The pagination metadata
                $items = $meta['data'];       // The actual list of users

                // 4. Rehydrate the Paginator
                // This creates a standard Laravel Paginator that Blade understands
                $usersPaginator = new LengthAwarePaginator(
                    $items, 
                    $meta['total'], 
                    $meta['per_page'], 
                    $meta['current_page'], 
                    [
                        'path' => $request->url(),   // IMPORTANT: Point links to THIS controller, not the API
                        'query' => $request->query() // IMPORTANT: Keep search params in pagination links
                    ]
                );
            }
        }

        // 5. Return View
        return view('dashboard.list-users', [
            'users' => $usersPaginator,
            'role' => $role,
            'title' => $pageTitle
        ]);
    }
}