@extends('layouts.app')

@section('title', 'Test Submitted')

@section('content')
<div class="min-h-screen bg-gray-50 flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-xl shadow-lg text-center">
        
        {{-- Success Icon --}}
        <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-green-100 mb-6">
            <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>

        <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
            Success!
        </h2>
        
        {{-- DYNAMIC MESSAGE FROM SESSION --}}
        @if(session('success_message'))
            <div class="mt-4 p-4 rounded-md bg-green-50 border border-green-200">
                <p class="text-lg text-green-700 font-medium">
                    {{ session('success_message') }}
                </p>
            </div>
        @else
            {{-- Fallback message if session expired or direct access --}}
            <p class="mt-2 text-sm text-gray-600">
                Your responses have been recorded successfully.
            </p>
        @endif

        <p class="mt-4 text-sm text-gray-500">
            Result Reference ID: <span class="font-mono font-bold text-gray-800">#{{ $result_id }}</span>
        </p>

        <div class="mt-8 space-y-3">
            <a href="{{ route('user.dashboard') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Test Report Dashboard
            </a>
            
        </div>
    </div>
</div>
@endsection