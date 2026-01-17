<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    // 1. Show the Packages Page
    public function udyantraPackage()
    {
        $baseUrl = config('services.backend.url');
        // Check if the user is logged in and get the token
        $token = session('api_token');
        $http = Http::acceptJson();

        // Conditionally add the token header only if a token exists
        if ($token) {
            $http->withToken($token);
        }
        
        //Without Token
        $response = $http->get("{$baseUrl}/udyantra-package");

        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['status']) && $responseData['status'] === true) {
                // Pass the grouped data and login status to the view
                return view('menu-pages.udyantra-package', [
                    'groupedPackages' => $responseData['data'],
                    // Pass a boolean to the view to check if a user is logged in
                    'isLoggedIn' => (bool) $token 
                ]);
            }
        }

        return view('menu-pages.udyantra-package', [
            'groupedPackages' => [],
            'isLoggedIn' => (bool) $token 
        ])->with('error', 'Unable to fetch packages.');
    }

    // 2. Proxy: Create Order
    public function createOrder(Request $request)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // Forward the request to the Backend API
        $response = Http::withToken($token)
            ->post("{$baseUrl}/create-order", [
                'package_id' => $request->package_id
            ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Failed to create order'], 500);
    }

    // 3. Proxy: Verify Payment
    public function verifyPayment(Request $request)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // Forward the payment details to Backend API for verification
        $response = Http::withToken($token)
            ->post("{$baseUrl}/verify-payment", $request->all());

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Payment verification failed'], 400);
    }
    
    // 4. Proxy: Thank You Page
    public function thankYou($orderId)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // 1. Fetch transaction details from Backend API
        $response = Http::withToken($token)
            ->get("{$baseUrl}/transaction/{$orderId}");

        if ($response->successful() && $response['status']) {
            $transaction = $response['data'];
            
            // 2. Show the Thank You View
            return view('pages.thank-you', ['transaction' => $transaction]);
        }

        return redirect()->route('dashboard')->with('error', 'Could not retrieve transaction details.');
    }
    
    //Dashboard Packages Page
    public function dashboardPackages()
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // 1. Force Redirect if not logged in
        if (!$token) {
            return redirect()->route('login');
        }

        // 2. Fetch Packages
        $response = Http::withToken($token)
            ->acceptJson()
            ->get("{$baseUrl}/udyantra-package");

        $groupedPackages = [];
        
        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['status']) && $responseData['status'] === true) {
                $groupedPackages = $responseData['data'];
            }
        }

        // 3. Return a DASHBOARD specific view
        return view('dashboard.package', [
            'groupedPackages' => $groupedPackages
        ]);
    }


}