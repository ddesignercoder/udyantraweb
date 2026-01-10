@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 py-12 px-4">
    
    {{-- Header --}}
    <div class="max-w-7xl mx-auto text-center mb-10">
        <h2 class="text-3xl font-extrabold text-gray-900">Your Career Compass Report</h2>
        <p class="mt-2 text-gray-600">Reference ID: #{{ $result_id }}</p>
    </div>

    {{-- Result Container --}}
    <div class="max-w-7xl mx-auto space-y-8">
        
        {{-- PROFILE SUMMARY --}}
        <div class="bg-white rounded-xl shadow-md overflow-hidden">
            <div class="bg-indigo-600 px-6 py-4">
                <h3 class="text-xl font-bold text-white">Your Dominant Profile</h3>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6 text-center">
                @foreach($analysis['user_profile_winners'] as $section => $traits)
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
                        <p class="text-xs font-semibold text-gray-500 uppercase">{{ $section }}</p>
                        <p class="mt-1 text-lg font-bold text-indigo-700">
                            {{-- Handle Array (Tie) vs String --}}
                            {{ is_array($traits) ? implode(' & ', $traits) : $traits }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TIE BREAKER ALERT --}}
        @if($analysis['is_tie_scenario'])
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                <p class="text-sm text-yellow-700">
                    <strong>Multiple Matches Found!</strong> We found {{ $analysis['match_count'] }} career paths.
                </p>
            </div>
        @endif

        {{-- OUTCOMES GRID --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            @foreach($outcomes as $outcome)
                <div class="bg-white rounded-xl shadow-lg border-l-4 border-indigo-500 overflow-hidden">
                    <div class="p-6">
                        <h4 class="text-xl font-bold text-gray-900">
                            {{ $outcome['personality'] }} + {{ $outcome['aptitude'] }} Path
                        </h4>
                        <p class="mt-4 text-gray-600 text-sm">
                            {{ $outcome['short_summary'] }}
                        </p>
                        
                        <div class="mt-4">
                            <strong>Streams:</strong>
                            {{-- Accessor logic handled in PHP or raw string --}}
                            {{ is_array($outcome['suggested_streams']) 
                                ? implode(', ', $outcome['suggested_streams']) 
                                : str_replace(';', ', ', $outcome['suggested_streams']) 
                            }}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</div>
@endsection