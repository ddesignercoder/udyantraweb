@extends('layouts.app')
@section('title', 'Register-Selection')
@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-2  px-4 sm:px-6 lg:px-8 lg:py-12">
    <div class="max-w-4xl w-full space-y-8">
        <div class="text-center">
            <h2 class="mt-2lg:mt-6 text-3xl font-extrabold text-gray-900">
                Join Us
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Choose how you want to register
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-10">
            <a href="{{ route('register.org.view') }}" class="group block p-8 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-blue-500 hover:shadow-md transition">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-blue-100 text-blue-600 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 group-hover:text-blue-600">For Organizations</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Register your School or Company to manage students and employees.
                </p>
            </a>

            <a href="{{ route('register.ind.view') }}" class="group block p-8 bg-white border border-gray-200 rounded-xl shadow-sm hover:border-green-500 hover:shadow-md transition">
                <div class="flex items-center justify-center h-12 w-12 rounded-md bg-green-100 text-green-600 mb-4">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900 group-hover:text-green-600">For Individuals</h3>
                <p class="mt-2 text-sm text-gray-500">
                    Create a personal account for yourself.
                </p>
            </a>
        </div>
    </div>
</div>
@endsection