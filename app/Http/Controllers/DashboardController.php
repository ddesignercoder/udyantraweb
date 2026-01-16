<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
    public function index()
    {
        // 1. Get User Data from Session (stored during Login/Register)
        $role = session('user_role');
        $userName = session('user_name');
        
        // 2. Define Dashboard Config based on Role
        // This helps us show different titles/widgets without messy Blade 'if's
        $dashboardConfig = $this->getRoleConfig($role);

        return view('dashboard.index', [
            'role' => $role,
            'user_name' => $userName,
            'config' => $dashboardConfig
        ]);
    }

    private function getRoleConfig($role)
    {
        return match ($role) {
            'school_admin' => [
                'title' => 'School Administration',
                'widgets' => ['Total Students', 'Class Performance', 'Pending Approvals'],
                'color' => 'blue'
            ],
            'company_admin' => [
                'title' => 'Company Management',
                'widgets' => ['Total Employees', 'Project Status', 'Hiring Pipeline'],
                'color' => 'indigo'
            ],
            'student' => [
                'title' => 'Student Portal',
                'widgets' => ['My Grades', 'Upcoming Tests', 'Attendance'],
                'color' => 'green'
            ],
            'employee' => [
                'title' => 'Employee Portal',
                'widgets' => ['My Tasks', 'Performance Review', 'Leave Status'],
                'color' => 'teal'
            ],
            default => [ // 'individual'
                'title' => 'My Dashboard',
                'widgets' => ['My Profile', 'Recent Activity'],
                'color' => 'gray'
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