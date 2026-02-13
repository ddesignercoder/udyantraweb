<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class EnquiryController extends Controller
{
    /**
     * Submit an enquiry to the backend API (Public - No Auth Required)
     */
    public function submit(Request $request)
    {
        $baseUrl = config('services.backend.url');

        $response = Http::post("{$baseUrl}/enquiry", [
            'name'    => $request->name,
            'email'   => $request->email,
            'phone'   => $request->phone,
            'message' => $request->message,
        ]);

        $data = $response->json();

        if ($response->successful() && isset($data['success']) && $data['success'] === true) {
            return back()->with('success', $data['message'] ?? 'Enquiry submitted successfully');
        }

        // Handle backend validation errors (422)
        if ($response->status() === 422 && isset($data['errors'])) {
            return back()
                ->withInput()
                ->withErrors($data['errors'])
                ->with('error', $data['message'] ?? 'Validation failed');
        }

        return back()
            ->withInput()
            ->with('error', $data['message'] ?? 'Failed to submit enquiry. Please try again.');
    }
}
