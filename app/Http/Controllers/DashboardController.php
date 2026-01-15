<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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

    public function listUsers()
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

        // 2. Fetch Data from API
        $response = \Illuminate\Support\Facades\Http::withToken($token)->get($baseUrl . $endpoint);

        $users = [];
        if ($response->successful()) {
            $users = $response->json()['data'];
        }

        // 3. Return View
        return view('dashboard.list-users', [
            'users' => $users,
            'role' => $role,
            'title' => $pageTitle
        ]);
    }
}