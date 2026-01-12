@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-linear-to-br from-cyan-50 via-teal-50 to-emerald-50 py-12 px-4">
    
    {{-- Header --}}
    <div class="max-w-7xl mx-auto text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-primary to-secondary">
            Your Career Report
        </h1>
        <p class="mt-3 text-lg text-gray-600">Reference ID: <span class="font-semibold text-primary">#{{ $result_id }}</span></p>
    </div>

    {{-- Result Container --}}
    <div class="max-w-7xl mx-auto space-y-8">
        
        {{-- PROFILE SUMMARY --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-linear-to-r from-primary to-secondary px-6 py-5">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Your Dominant Profile
                </h2>
            </div>
            <div class="p-6 grid grid-cols-1 md:grid-cols-4 gap-6">
                @foreach($analysis['user_profile_winners'] as $section => $traits)
                    <div class="p-5 bg-linear-to-br from-teal-50 to-cyan-50 rounded-xl border-2 border-secondary hover:shadow-lg transition-shadow duration-300">
                        <p class="text-xs font-bold text-primary uppercase tracking-wide">{{ $section }}</p>
                        <p class="mt-2 text-lg font-extrabold text-gray-900">
                            {{ is_array($traits) ? implode(' & ', $traits) : $traits }}
                        </p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- TIE BREAKER ALERT --}}
        @if($analysis['is_tie_scenario'])
            <div class="bg-linear-to-r from-yellow-50 to-amber-50 border-l-4 border-yellow-500 p-5 rounded-lg shadow-md">
                <div class="flex items-center">
                    <svg class="w-6 h-6 text-yellow-600 mr-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                    <p class="text-sm font-semibold text-yellow-800">
                        <strong>Multiple Matches Found!</strong> We found {{ $analysis['match_count'] }} career paths that suit your profile.
                    </p>
                </div>
            </div>
        @endif

        {{-- OUTCOMES GRID --}}
        @foreach($outcomes as $index => $outcome)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 hover:shadow-2xl transition-shadow duration-300">
                
                {{-- Outcome Header --}}
                <div class="bg-linear-to-r from-primary to-secondary px-6 py-5">
                    <div class="flex items-center justify-between">
                        <h3 class="text-2xl font-bold text-white">
                            Career Path {{ $index + 1 }}
                        </h3>
                        <span class="bg-white text-primary px-4 py-1 rounded-full text-sm font-bold">
                            {{ $outcome['personality'] }} × {{ $outcome['aptitude'] }}
                        </span>
                    </div>
                </div>

                <div class="p-6 space-y-6">
                    
                    {{-- Profile Combination --}}
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg border border-blue-200">
                            <p class="text-xs font-semibold text-blue-600 uppercase">Personality</p>
                            <p class="mt-1 text-sm font-bold text-gray-900">{{ $outcome['personality'] }}</p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg border border-green-200">
                            <p class="text-xs font-semibold text-green-600 uppercase">Orientation</p>
                            <p class="mt-1 text-sm font-bold text-gray-900">{{ $outcome['orientation'] }}</p>
                        </div>
                        <div class="bg-purple-50 p-4 rounded-lg border border-purple-200">
                            <p class="text-xs font-semibold text-purple-600 uppercase">Aptitude</p>
                            <p class="mt-1 text-sm font-bold text-gray-900">{{ $outcome['aptitude'] }}</p>
                        </div>
                        <div class="bg-orange-50 p-4 rounded-lg border border-orange-200">
                            <p class="text-xs font-semibold text-orange-600 uppercase">Motivation</p>
                            <p class="mt-1 text-sm font-bold text-gray-900">{{ $outcome['motivation'] }}</p>
                        </div>
                    </div>

                    {{-- Short Summary --}}
                    <div class="bg-gray-50 p-5 rounded-lg border border-gray-200">
                        <p class="text-gray-700 leading-relaxed">{{ $outcome['short_summary'] }}</p>
                    </div>

                    {{-- Suggested Streams --}}
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-primary" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.257l4-1.714a1 1 0 11.788 1.838L7.667 9.088l1.94.831a1 1 0 00.787 0l7-3a1 1 0 000-1.838l-7-3zM3.31 9.397L5 10.12v4.102a8.969 8.969 0 00-1.05-.174 1 1 0 01-.89-.89 11.115 11.115 0 01.25-3.762zM9.3 16.573A9.026 9.026 0 007 14.935v-3.957l1.818.78a3 3 0 002.364 0l5.508-2.361a11.026 11.026 0 01.25 3.762 1 1 0 01-.89.89 8.968 8.968 0 00-5.35 2.524 1 1 0 01-1.4 0zM6 18a1 1 0 001-1v-2.065a8.935 8.935 0 00-2-.712V17a1 1 0 001 1z"/>
                            </svg>
                            Suggested Streams & Careers
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(';', $outcome['suggested_streams']) as $stream)
                                <span class="bg-teal-100 text-primary-dark px-3 py-1 rounded-full text-sm font-medium">
                                    {{ trim($stream) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Suggested Subjects --}}
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 4.804A7.968 7.968 0 005.5 4c-1.255 0-2.443.29-3.5.804v10A7.969 7.969 0 015.5 14c1.669 0 3.218.51 4.5 1.385A7.962 7.962 0 0114.5 14c1.255 0 2.443.29 3.5.804v-10A7.968 7.968 0 0014.5 4c-1.255 0-2.443.29-3.5.804V12a1 1 0 11-2 0V4.804z"/>
                            </svg>
                            Suggested Subjects
                        </h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(';', $outcome['suggested_subjects']) as $subject)
                                <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ trim($subject) }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    {{-- Top Life Skills --}}
                    <div>
                        <h4 class="text-lg font-bold text-gray-900 mb-3 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            Top Life Skills to Develop
                        </h4>
                        <ul class="space-y-2">
                            @foreach(explode(';', $outcome['top_life_skills']) as $skill)
                                <li class="flex items-center text-gray-700">
                                    <svg class="w-4 h-4 mr-2 text-secondary" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                    </svg>
                                    {{ trim($skill) }}
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    {{-- Strengths & Areas to Improve --}}
                    <div class="grid md:grid-cols-2 gap-6">
                        {{-- Strengths --}}
                        <div class="bg-green-50 p-5 rounded-lg border border-green-200">
                            <h4 class="text-lg font-bold text-green-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                Strengths
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode(';', $outcome['strengths']) as $strength)
                                    <li class="flex items-start text-sm text-gray-700">
                                        <span class="text-green-600 mr-2">✓</span>
                                        <span>{{ trim($strength) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        {{-- Areas to Improve --}}
                        <div class="bg-amber-50 p-5 rounded-lg border border-amber-200">
                            <h4 class="text-lg font-bold text-amber-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                Areas to Improve
                            </h4>
                            <ul class="space-y-2">
                                @foreach(explode(';', $outcome['areas_to_improve']) as $area)
                                    <li class="flex items-start text-sm text-gray-700">
                                        <span class="text-amber-600 mr-2">→</span>
                                        <span>{{ trim($area) }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>

                    {{-- Detailed Report (Collapsible) --}}
                    <details class="bg-gray-50 rounded-lg border border-gray-200">
                        <summary class="cursor-pointer p-4 font-bold text-gray-900 hover:bg-gray-100 rounded-lg transition-colors">
                            📄 View Detailed Report
                        </summary>
                        <div class="p-4 pt-0">
                            <div class="prose prose-sm max-w-none text-gray-700 whitespace-pre-line">
                                {{ $outcome['detailed_report'] }}
                            </div>
                        </div>
                    </details>

                </div>
            </div>
        @endforeach


    </div>
</div>
@endsection