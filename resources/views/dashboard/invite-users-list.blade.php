@extends('layouts.dashboard')

@section('title', 'Users registered under ' . $formTag)

@section('content')

    <div class="max-w-6xl mx-auto space-y-6">
        
        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <a href="{{ route('dashboard.invite-members') }}" class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-primary transition font-medium mb-2">
                    <x-lucide-arrow-left class="w-4 h-4" />
                    Back to Invite Members
                </a>
                <h1 class="text-2xl font-bold text-gray-900">Users Registered Under Form Tag: <span class="text-primary font-mono bg-blue-50 px-2 py-1 rounded border border-blue-100">{{ $formTag }}</span></h1>
                @if($users)
                    <p class="text-gray-600 mt-1">Total Users Found: {{ $users->total() }}</p>
                @endif
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 uppercase font-semibold text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            <th class="px-6 py-4">Phone</th>
                            <th class="px-6 py-4">Registered On</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @if($users && $users->count() > 0)
                            @foreach($users as $user)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        {{ $user['name'] }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs">
                                        {{ $user['email'] }}
                                    </td>
                                    <td class="px-6 py-4 font-mono text-xs">
                                        {{ $user['phone'] ?? 'N/A' }}
                                    </td>
                                    <td class="px-6 py-4 text-xs">
                                        {{ \Carbon\Carbon::parse($user['created_at'])->format('d M, Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <x-lucide-users class="w-10 h-10 text-gray-300 mb-2" />
                                        <p>No registered users found for this form tag.</p>
                                    </div>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            @if($users && $users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{ $users->withQueryString()->links('components.notes.notes-pagenation') }}
                </div>
            @endif
        </div>
    </div>
@endsection
