@extends('layouts.app') 
@section('title', 'Help Link')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
<section class="relative bg-secondary w-full">
        <div class="max-w-7xl mx-auto px-4 md:px-6 pt-16 pb-0  relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-center">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center md:text-left space-y-6 w-full md:max-w-xl ">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                       Help Center & SOP Guides
                    </h1>
                    
                    <p class="text-textBlack text-lg md:text-xl leading-tight">
                        Find step-by-step guides to help you navigate the Udyantra platform. <br/><br/>These SOPs explain how to register, log in, and understand pricing so you can get started quickly.
                    </p>
                </div>

                {{-- 3. Right Side: OverlapDevice Mockup Image --}}
                <div class="text-center">
                    <img  src="{{ asset('assets/image/sop-banner.svg') }}" 
                    alt="Help Links & SOPs" fetchpriority="high"
                    class="mx-auto pointer-events-none w-[500px] mt-3 md:mt-0">
                </div>

            </div>
        </div>
    </section>
    
<!-- <section class="relative w-full bg-gray-50 min-h-screen">
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
</section> -->
<section class="relative bg-gray-100 w-full py-16 lg:py-22">
   <div class="max-w-7xl mx-auto px-4 md:px-6">
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
               <p class="font-normal text-md text-gray-600">Step-by-step guide to securely log in to your Udyantra account.<br/>Learn how to access the dashboard, reset passwords, and troubleshoot login issues.</p>
               <p class="inline-flex justify-center items-center  font-normal text-md text-textBlack text-center mt-4 border-b-2 border-current px-3">View Guide →</p>
            </a>

            {{-- Pricing SOP --}}
            <a href="{{ asset('assets/help-link-pdf/pricing.pdf') }}" target="_blank" class="block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1 hover:ring-2 hover:ring-primary/50 text-center">
               <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-50 mb-4 transition-colors group-hover:bg-green-100">
                  <x-lucide-file-text class="h-8 w-8 text-primary" />
               </div>
               <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Pricing SOP</h2>
               <p class="font-normal text-md text-gray-600">Understand Udyantra pricing plans, features, and package details.<br/>This guide explains plan differences and how to choose the right one.</p>
               <p class="inline-flex justify-center items-center  font-normal text-md text-textBlack text-center mt-4 border-b-2 border-current px-3">Explore Pricing →</p>
            </a>

            {{-- Registration SOP --}}
            <a href="{{ asset('assets/help-link-pdf/registration.pdf') }}" target="_blank" class="block p-6 bg-white border border-gray-200 rounded-xl shadow hover:shadow-xl transition-all duration-300 hover:-translate-y-1 hover:ring-2 hover:ring-primary/50 text-center">
               <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-purple-50 mb-4 transition-colors group-hover:bg-purple-100">
                  <x-lucide-user-plus class="h-8 w-8 text-primary" />
               </div>
               <h2 class="mb-2 text-xl font-bold tracking-tight text-gray-900">Registration SOP</h2>
               <p class="font-normal text-md text-gray-600">Follow this simple guide to create your Udyantra account.<br/>Includes verification steps and tips to complete your profile successfully.</p>
               <p class="inline-flex justify-center items-center  font-normal text-md text-textBlack text-center mt-4 border-b-2 border-current px-3">Start Registration →</p>
            </a>
         </div>

      </div>
   </div>
</section>
@endsection