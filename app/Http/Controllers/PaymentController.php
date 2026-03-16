<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    // 1. Show the Packages Page (Public)
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

    // 2. Proxy: Create Order (HDFC Juspay)
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

    // 3. Payment Callback (Return URL from HDFC Juspay)
    // User is redirected here after completing/cancelling payment on SmartGateway
    public function paymentCallback(Request $request)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        Log::info('HDFC Frontend Callback Received', [
            'method' => $request->method(),
            'all_input' => $request->all()
        ]);

        // Extract order_id from the return URL (Juspay POSTs this data back or GET query params)
        $orderId = $request->input('order_id') ?? $request->query('order_id');
        $status  = $request->input('status') ?? $request->query('status');

        if (!$orderId) {
            Log::error('HDFC Frontend Callback: Missing order_id');
            return redirect()->route('dashboard.packages')->with('error', 'Invalid payment response.');
        }

        Log::info('HDFC Frontend Callback: Verifying payment with backend', [
            'order_id' => $orderId,
            'status_from_juspay' => $status
        ]);

        // Verify payment status via backend's Server-to-Server call
        $response = Http::withToken($token)
            ->acceptJson()
            ->post("{$baseUrl}/verify-payment", [
                'order_id' => $orderId
            ]);

        Log::info('HDFC Frontend Callback: Backend Verification Response', [
            'status_code' => $response->status(),
            'parsed_json' => $response->json(),
            'raw_body'    => $response->body(),
            'is_successful' => $response->successful()
        ]);

        if ($response->successful() && $response->json('status') === true) {
            return redirect()->route('payment.thankyou', ['orderId' => $orderId]);
        }

        // Payment failed or pending
        $message = $response->json('message') ?? 'Payment could not be verified.';
        Log::error('HDFC Frontend Callback: Verification Failed', ['message' => $message]);
        
        return redirect()->route('dashboard.packages')->with('error', $message);
    }


    // 4. Proxy: Verify Payment (AJAX call from frontend)
    public function verifyPayment(Request $request)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // Forward the order_id to Backend API for verification
        $response = Http::withToken($token)
            ->post("{$baseUrl}/verify-payment", [
                'order_id' => $request->order_id
            ]);

        if ($response->successful()) {
            return response()->json($response->json());
        }

        return response()->json(['error' => 'Payment verification failed'], 400);
    }
    
    // 5. Thank You Page
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

        return redirect()->route('user.dashboard')->with('error', 'Could not retrieve transaction details.');
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

    // My Purchases - Package Order History
    public function myPurchases()
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // 1. Force Redirect if not logged in
        if (!$token) {
            return redirect()->route('login');
        }

        // 2. Fetch Purchase History
        $response = Http::withToken($token)
            ->acceptJson()
            ->get("{$baseUrl}/my-purchases");

        $groupedPurchases = [];
        
        if ($response->successful()) {
            $responseData = $response->json();
            if (isset($responseData['status']) && $responseData['status'] === true) {
                // Data is already grouped by category
                $groupedPurchases = $responseData['data'];
            }
        }

        // 3. Return the purchase history view
        return view('dashboard.package-order-history', [
            'groupedPurchases' => $groupedPurchases
        ]);
    }

}