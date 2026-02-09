@extends('layouts.app')
@section('title', 'Join Us - Select Registration Type')
@section('content')
<div class=" flex items-center justify-center bg-gray-50 p-6 md:p-22">
    <div class="max-w-4xl w-full space-y-8">
        <div class="text-center">
            <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                Join Us
            </h1>
            <p class="text-textBlack text-lg md:text-xl leading-tight">
                Choose how you want to get started with Udyantra
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:gap-8">
            <!-- Organization Card -->
            <a href="{{ route('register.org.view') }}" class="group relative block rounded-xl border-2 border-primary bg-white p-6 shadow-sm  hover:border-primary/80 hover:shadow-lg focus:outline-none ">
                <div class="flex flex-col items-center text-center">
                    <div class="mb-6 inline-flex h-16 w-16 items-center justify-center rounded-xl bg-blue-50 text-primary transition-colors duration-200 group-hover:bg-blue-100">
                        <x-lucide-building-2 class="h-8 w-8" />
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 transition-colors duration-200 group-hover:text-primary">
                        For Organizations
                    </h2>
                    <p class="mt-4 text-md text-gray-500 hover:text-black leading-relaxed">
                        Register your School or Company to manage students, employees, and assessments efficiently.
                    </p>
                </div>
            </a>

            <!-- Individual Card -->
            <a href="{{ route('register.ind.view') }}" class="group relative block rounded-xl border-2 border-primary bg-white p-6 shadow-sm transition-all duration-200 hover:border-primary/80 hover:shadow-lg focus:outline-none ">
                <div class="flex flex-col items-center text-center">
                    <div class="mb-6 inline-flex h-16 w-16 items-center justify-center rounded-xl bg-blue-50 text-primary transition-colors duration-200 group-hover:bg-blue-100">
                        <x-lucide-user class="h-8 w-8" />
                    </div>
                    <h2 class="text-xl font-bold text-gray-900 transition-colors duration-200 group-hover:text-primary">
                        For Individuals
                    </h2>
                    <p class="mt-4 text-md text-gray-500 hover:text-black leading-relaxed">
                        Create a personal account to access tests, track progress, and improve your skills.
                    </p>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection