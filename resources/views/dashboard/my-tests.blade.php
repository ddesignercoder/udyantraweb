@extends('layouts.dashboard')

@section('title', 'My Tests')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Header -->
    <div class="mb-8 flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="p-2 bg-teal-50 text-teal-600 rounded-xl">
                    <x-lucide-clipboard-list class="w-6 h-6 md:w-8 md:h-8" />
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                    My Assigned Tests
                </h1>
            </div>
            <p class="text-gray-500 text-sm md:text-base ml-1">
                Explore and complete your personalized psychometric assessments
            </p>
        </div>

        <a href="{{ route('test.report.dashboard') }}" 
           class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-white border-2 border-primary text-primary font-bold rounded-xl hover:bg-primary hover:text-white transition-all duration-300 shadow-sm hover:shadow-md group">
            <x-lucide-bar-chart-3 class="w-5 h-5 group-hover:rotate-12 transition-transform" />
            View Results Dashboard
        </a>
    </div>

    @if(count($tests) > 0)
        <!-- Tests Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($tests as $test)
                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow overflow-hidden border border-gray-200">
                    <!-- Test Header -->
                    <div class="bg-linear-to-r from-teal-600 to-cyan-600 p-4 text-white">
                        <h3 class="text-xl font-bold">{{ $test['test_name'] }}</h3>
                        <p class="text-sm opacity-90">{{ $test['category'] }}</p>
                    </div>

                    <!-- Test Details -->
                    <div class="p-6 space-y-4">
                        <!-- Usage Stats -->
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex justify-between items-center mb-2">
                                <span class="text-sm text-gray-600">Attempts</span>
                                <span class="font-semibold text-gray-900">
                                    {{ $test['current_usage'] }} / {{ $test['max_usage'] }}
                                </span>
                            </div>
                            
                            <!-- Progress Bar -->
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div 
                                    class="bg-teal-600 h-2 rounded-full transition-all"
                                    style="width: {{ $test['max_usage'] > 0 ? ($test['current_usage'] / $test['max_usage'] * 100) : 0 }}%"
                                ></div>
                            </div>
                            
                            <p class="text-xs text-gray-500 mt-2">
                                {{ $test['remaining_attempts'] }} attempt(s) remaining
                            </p>
                        </div>

                        <!-- Assigned By -->
                        <div class="flex items-center text-sm">
                            <x-lucide-user class="w-4 h-4 mr-2 text-gray-500" />
                            <span class="text-gray-600">
                                Assigned by: <span class="font-medium">{{ $test['assigned_by'] }}</span>
                            </span>
                        </div>

                        <!-- Status Badge -->
                        @if($test['is_active'] && $test['remaining_attempts'] > 0 && $test['days_remaining'] > 0)
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    <span class="w-2 h-2 bg-green-500 rounded-full mr-2"></span>
                                    Active
                                </span>
                            </div>
                        @elseif($test['remaining_attempts'] <= 0)
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                    <span class="w-2 h-2 bg-gray-500 rounded-full mr-2"></span>
                                    Completed
                                </span>
                            </div>
                        @elseif($test['days_remaining'] <= 0)
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                    <span class="w-2 h-2 bg-red-500 rounded-full mr-2"></span>
                                    Expired
                                </span>
                            </div>
                        @else
                            <div class="flex items-center">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                    <span class="w-2 h-2 bg-yellow-500 rounded-full mr-2"></span>
                                    Inactive
                                </span>
                            </div>
                        @endif
                    </div>

                    <!-- Action Button -->
                    <div class="p-6 pt-0">
                        @if($test['is_active'] && $test['remaining_attempts'] > 0 && $test['days_remaining'] > 0)
                            <a 
                                href="{{ route('test-panel', ['slug' => $test['test_slug']]) }}"
                                class="block w-full bg-teal-600 text-white text-center py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors"
                            >
                                Take Test
                            </a>
                        @elseif($test['remaining_attempts'] <= 0)
                            <button 
                                disabled
                                class="block w-full bg-gray-300 text-gray-600 text-center py-3 rounded-lg font-semibold cursor-not-allowed"
                            >
                                All Attempts Used
                            </button>
                        @elseif($test['days_remaining'] <= 0)
                            <button 
                                disabled
                                class="block w-full bg-gray-300 text-gray-600 text-center py-3 rounded-lg font-semibold cursor-not-allowed"
                            >
                                Test Expired
                            </button>
                        @else
                            <button 
                                disabled
                                class="block w-full bg-gray-300 text-gray-600 text-center py-3 rounded-lg font-semibold cursor-not-allowed"
                            >
                                Test Inactive
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <!-- Empty State -->
        <div class="bg-white rounded-lg shadow-md p-12 text-center">
            <div class="mx-auto w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mb-6">
                <x-lucide-file-text class="w-12 h-12 text-gray-400" />
            </div>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">No Tests Assigned Yet</h3>
            <p class="text-gray-600 mb-6">
                @if($role === 'individual')
                    Purchase a package to get started with psychometric tests.
                @else
                    Your admin will assign tests to you soon.
                @endif
            </p>
            @if($role === 'individual')
                <a 
                    href="{{ route('dashboard.packages') }}"
                    class="inline-block bg-teal-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-teal-700 transition-colors"
                >
                    Browse Packages
                </a>
            @endif
        </div>
    @endif
</div>
@endsection