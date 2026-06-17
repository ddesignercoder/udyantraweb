<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;

class NotesController extends Controller
{
    /**
     * Show notes for a specific user.
     */
    public function showUserNotes(Request $request, $encryptedId)
    {
        try {
            $userId = decrypt($encryptedId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('dashboard.list-users')->with('error', 'Invalid user ID.');
        }

        $baseUrl = config('services.backend.url');
        $token = session('api_token');
        $page = $request->query('page', 1);

        // Fetch notes from backend
        $response = Http::withToken($token)
            ->acceptJson()
            ->get("{$baseUrl}/users/{$userId}/notes", [
                'page' => $page
            ]);
        // dd($response); 
        if ($response->successful()) {
            $apiData = $response->json();
            if ($apiData['status'] ?? false) {
                // Reconstruct LengthAwarePaginator
                $notesPaginator = new LengthAwarePaginator(
                    $apiData['data']['data'] ?? [],
                    $apiData['data']['total'] ?? 0,
                    $apiData['data']['per_page'] ?? 10,
                    $apiData['data']['current_page'] ?? 1,
                    [
                        'path' => $request->url(),
                        'query' => $request->query(),
                    ]
                );

                return view('notes.index', [
                    'notes' => $notesPaginator,
                    'user' => $apiData['user'],
                    'encrypted_user_id' => $encryptedId
                ]);
            }
        }

        return redirect()->route('dashboard.list-users')->with('error', 'Failed to fetch notes.');
    }

    /**
     * Store a new note for a user.
     */
    public function storeNote(Request $request, $encryptedId)
    {
        try {
            $userId = decrypt($encryptedId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect()->route('dashboard.list-users')->with('error', 'Invalid user ID.');
        }

        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        $response = Http::withToken($token)
            ->acceptJson()
            ->post("{$baseUrl}/users/{$userId}/notes", [
                'content' => $request->content,
            ]);

        if ($response->successful()) {
            return redirect()->route('user-notes', ['id' => $encryptedId])->with('success', 'Note added successfully.');
        }

        return redirect()->route('user-notes', ['id' => $encryptedId])
            ->withErrors($response->json()['errors'] ?? [])
            ->with('error', $response->json()['message'] ?? 'Failed to add note.');
    }

    /**
     * Update an existing note.
     */
    public function updateNote(Request $request, $noteId)
    {
        $encryptedUserId = $request->input('user_id');

        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        $response = Http::withToken($token)
            ->acceptJson()
            ->put("{$baseUrl}/notes/{$noteId}", [
                'content' => $request->content,
            ]);

        if ($response->successful()) {
            return redirect()->route('user-notes', ['id' => $encryptedUserId])->with('success', 'Note updated successfully.');
        }

        return redirect()->route('user-notes', ['id' => $encryptedUserId])
            ->withErrors($response->json()['errors'] ?? [])
            ->with('error', $response->json()['message'] ?? 'Failed to update note.');
    }

    /**
     * Delete an existing note.
     */
    public function destroyNote(Request $request, $noteId)
    {
        $encryptedUserId = $request->input('user_id');

        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        $response = Http::withToken($token)
            ->acceptJson()
            ->delete("{$baseUrl}/notes/{$noteId}");

        if ($response->successful()) {
            return redirect()->route('user-notes', ['id' => $encryptedUserId])->with('success', 'Note deleted successfully.');
        }

        return redirect()->route('user-notes', ['id' => $encryptedUserId])
            ->with('error', $response->json()['message'] ?? 'Failed to delete note.');
    }
}
