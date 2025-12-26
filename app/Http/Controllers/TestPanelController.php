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

            $response = Http::acceptJson() 
                ->withToken($token)
                ->get("{$baseUrl}/psychometric/{$slug}/preview");

            if ($response->successful()) {
                $responseData = $response->json();

                if (isset($responseData['status']) && $responseData['status'] === true) {
                    $data = $responseData['data'];
                    
                    // dd($data['questions']);
                    return view('pages.test-panel', [
                        'test' => $data['test'],
                        'questions' => $data['questions']
                    ]);
                }
            }

            $errorMessage = $response->json()['message'] ?? 'Unable to load test.';
            return redirect()->route('welcome')->with('error', $errorMessage);
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

        public function result($id)
        {
            // Optional: You could call the backend API here to get score details if needed
            // For now, we just pass the ID to the view
            return view('pages.test-result', ['result_id' => $id]);
        }


}