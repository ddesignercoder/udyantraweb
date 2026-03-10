@extends('layouts.app') 
@section('title', 'Help Link')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<section class="relative w-full bg-gray-50 min-h-screen">
   <div class="max-w-6xl mx-auto px-4 md:px-6 py-8 md:py-16 relative z-10">
      <div class="bg-white space-y-6 p-8 md:p-12 rounded-2xl shadow-lg transition-all duration-300">
         <h1 class="text-sizeMobile lg:text-3xl font-semibold text-center text-black font-sans mb-8">
            Help Links & SOPs
         </h1>

         <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            {{-- Login SOP --}}
            <a href="{{ asset('assets/help-link-pdf/login.pdf') }}" target="_blank" class="block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1 hover:ring-2 hover:ring-primary/50 text-center">
               <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-blue-50 mb-4 transition-colors group-hover:bg-blue-100">
                  <x-lucide-log-in class="h-8 w-8 text-primary" />
               </div>
               <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Login SOP</h2>
               <p class="font-normal text-sm text-gray-600">Step-by-step guide for logging into the platform.</p>
            </a>

            {{-- Pricing SOP --}}
            <a href="{{ asset('assets/help-link-pdf/pricing.pdf') }}" target="_blank" class="block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1 hover:ring-2 hover:ring-primary/50 text-center">
               <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-50 mb-4 transition-colors group-hover:bg-green-100">
                  <x-lucide-file-text class="h-8 w-8 text-primary" />
               </div>
               <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Pricing SOP</h2>
               <p class="font-normal text-sm text-gray-600">Detailed information about pricing and packages.</p>
            </a>

            {{-- Registration SOP --}}
            <a href="{{ asset('assets/help-link-pdf/registration.pdf') }}" target="_blank" class="block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1 hover:ring-2 hover:ring-primary/50 text-center">
               <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-purple-50 mb-4 transition-colors group-hover:bg-purple-100">
                  <x-lucide-user-plus class="h-8 w-8 text-primary" />
               </div>
               <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Registration SOP</h2>
               <p class="font-normal text-sm text-gray-600">Guide to registering a new account step by step.</p>
            </a>
         </div>

      </div>
   </div>
</section>
@endsection