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

    public function viewBulkUploadUsers()
    {
        $role = session('user_role');
        return view('dashboard.bulk-upload-users', compact('role'));
    }
    /**
     * Bulk upload users (students/employees) via CSV file
     */
    public function bulkUploadUsers(Request $request)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');
        $role = session('user_role');

        // 1. Validate CSV file
        $request->validate([
            'csv_file' => 'required|file|mimes:csv|max:5120',//5mb
        ]);

        // 2. Determine Endpoint based on Role
        $endpoint = $role === 'school_admin' 
            ? '/school/bulk-upload-students' 
            : '/company/bulk-upload-employees';

        // 3. Get the uploaded file
        $file = $request->file('csv_file');

        // 4. Call API with multipart form data
        $response = Http::withToken($token)
            ->attach('csv_file', file_get_contents($file->getRealPath()), $file->getClientOriginalName())
            ->post($baseUrl . $endpoint);

        // 5. Handle Response
        $responseData = $response->json();

        if ($response->successful() && ($responseData['status'] ?? false)) {
            $successCount = $responseData['success_count'] ?? 0;
            $errorCount = $responseData['error_count'] ?? 0;
            $errors = $responseData['errors'] ?? [];

            if ($errorCount > 0) {
                return back()
                    ->with('warning', "Bulk upload completed with {$successCount} success(es) and {$errorCount} error(s).")
                    ->with('bulk_errors', $errors);
            }

            return back()->with('success', "Bulk upload completed successfully! {$successCount} user(s) created.");
        }

        return back()
            ->withErrors($responseData['errors'] ?? [])
            ->with('error', $responseData['message'] ?? 'Bulk upload failed.');
    }
}