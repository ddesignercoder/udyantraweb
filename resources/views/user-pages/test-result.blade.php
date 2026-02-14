@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-linear-to-br from-cyan-50 via-teal-50 to-emerald-50 py-12 px-4">
    
    {{-- Header --}}
    <div class="max-w-7xl mx-auto text-center mb-10">
        <h1 class="text-4xl md:text-5xl font-extrabold text-transparent bg-clip-text bg-linear-to-r from-primary to-secondary">
            Your Career Report 
        </h1>
        <p class="mt-3 text-lg text-gray-600">Reference ID: <span class="font-semibold text-primary">#{{ $result_id }}</span> | <br class="md:hidden"> <span class="font-semibold text-primary">{{ $test_name }}</span></p>
    </div>

    {{-- Result Container --}}
    <div class="max-w-7xl mx-auto space-y-8">
        
        {{-- PROFILE SUMMARY --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="bg-linear-to-r from-primary to-secondary px-6 py-5">
                <h2 class="text-2xl font-bold text-white flex items-center">
                    <x-lucide-user class="w-6 h-6 mr-2" />
                    Dominant Profile Of {{ $user_name }}
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
                    <x-lucide-alert-triangle class="w-6 h-6 text-yellow-600 mr-3" />
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
                        <!-- <span class="bg-white text-primary px-4 py-1 rounded-full text-sm font-bold">
                            {{ $outcome['personality'] }} × {{ $outcome['aptitude'] }}
                        </span> -->
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
                            <x-lucide-graduation-cap class="w-5 h-5 mr-2 text-primary" />
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
                            <x-lucide-book-open class="w-5 h-5 mr-2 text-green-600" />
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
                            <x-lucide-badge-check class="w-5 h-5 mr-2 text-secondary" />
                            Top Life Skills to Develop
                        </h4>
                        <ul class="space-y-2">
                            @foreach(explode(';', $outcome['top_life_skills']) as $skill)
                                <li class="flex items-center text-gray-700">
                                    <x-lucide-circle-check class="w-4 h-4 mr-2 text-secondary" />
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
                                <x-lucide-circle-check class="w-5 h-5 mr-2" />
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
                                <x-lucide-alert-circle class="w-5 h-5 mr-2" />
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