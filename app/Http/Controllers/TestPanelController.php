<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestPanelController extends Controller
{
    /**
     * Display the specific test to the user.
     * Expects a route like: /test-panel/{slug}
     */
    public function show($slug)
    {
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        if (!$token) {
            return redirect()->route('login')->with('error', 'Session expired.');
        }

        // Validate test access first
        $accessResponse = Http::withToken($token)
            ->get("{$baseUrl}/psychometric/{$slug}/validate-access");

        if (!$accessResponse->successful() || !$accessResponse->json()['status']) {
            $errorMessage = $accessResponse->json()['message'] ?? 'You do not have access to this test.';
            return redirect()->route('dashboard.my-tests')->with('error', $errorMessage);
        }

        // If access is granted, load the test
        $response = Http::acceptJson() 
            ->withToken($token)
            ->get("{$baseUrl}/psychometric/{$slug}/preview");

        if ($response->successful()) {
            $responseData = $response->json();

            if (isset($responseData['status']) && $responseData['status'] === true) {
                $data = $responseData['data'];
                
                return view('user-pages.test-panel', [
                    'test' => $data['test'],
                    'questions' => $data['questions']
                ]);
            }
        }

        $errorMessage = $response->json()['message'] ?? 'Unable to load test.';
        return redirect()->route('dashboard.my-tests')->with('error', $errorMessage);
    }


    public function submit(Request $request)
        {
            // 1. Get Token & Config
            $token = session('api_token');
            $baseUrl = config('services.backend.url');

            // 2. Forward the request to the Backend API
            // We pass $request->all() which contains answers, test_id, etc.
            $response = Http::withToken($token)
                ->acceptJson()
                ->post("{$baseUrl}/submit-test", $request->all());

            // 3. Return the Backend's response back to your JS
            if ($response->successful()) {
            $data = $response->json();
            
            // --- THE FIX: Flash message to Session ---
            // This stores the message securely on the server for the next request
            $msg = $data['message'] ?? 'Test Submitted Successfully';
            session()->flash('success_message', $msg);

            return response()->json([
                'status' => true,
                'result_id' => $data['result_id']
            ]);
        }
            // if ($response->successful()) {
            //     return response()->json($response->json());
            // }

            // Handle Error
            return response()->json([
                'message' => 'Submission failed',
                'error' => $response->body()
            ], $response->status());
        }

    public function testSubmittedResponse($id)
        {
            return view('user-pages.test-submitted-response', ['result_id' => $id]);
        }

    /**
     * Server-Side Fetch for Dashboard
     */
    public function dashboard()
        {
            $baseUrl = config('services.backend.url');
            $token = session('api_token');
            $userId = session('user_id');

            // 1. Call the API
            $response = Http::withToken($token)
                ->acceptJson()
                ->get("{$baseUrl}/user-test-history", [
                    'user_id' => $userId
                ]);

            $history = [];
            $totalTests = 0;

            if ($response->successful()) {
                $data = $response->json();
                $history = $data['history'] ?? [];
                $totalTests = $data['total_tests_taken'] ?? 0;
            }

            // 2. Pass data to View
            return view('user-pages.user-dashboard', compact('history', 'totalTests'));
        }

    /**
    * Server-Side Fetch for Result Page
    */
    public function result($id)
        {
            $baseUrl = config('services.backend.url');
            $token = session('api_token');
            $userId = session('user_id');

            // 1. Call the API from the Server
            $response = Http::withToken($token)
                ->acceptJson()
                ->get("{$baseUrl}/career-analysis", [
                    'user_id' => $userId,
                    'test_result_id' => $id
                ]);

            if ($response->successful()) {
                $data = $response->json();
                //dd($data);
                // 2. Pass the array directly to the View
                return view('user-pages.test-result', [
                    'result_id' => $id,
                    'analysis' => $data['analysis'],
                    'outcomes' => $data['outcomes'] ?? [] // Handle empty cases
                ]);
            }

            return redirect()->route('user.dashboard')->with('error', 'Could not fetch results.');
        }



}