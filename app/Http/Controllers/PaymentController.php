<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    // 1. Show the Packages Page
    public function udyantraPackage()
    {
        $baseUrl = config('services.backend.url'); // Ensure this is set in config/services.php
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Session expired.');
        }

        $response = Http::acceptJson()
            ->withToken($token)
            ->get("{$baseUrl}/udyantra-package");

        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['status']) && $responseData['status'] === true) {
                // Pass the grouped data to the view
                return view('pages.udyantra-package', [
                    'groupedPackages' => $responseData['data'] 
                ]);
            }
        }

        return back()->with('error', 'Unable to fetch packages.');
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

}