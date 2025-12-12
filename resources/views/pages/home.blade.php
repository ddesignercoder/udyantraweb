@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Main Hero Section --}}

    <section class="relative bg-[#9BE1F5] w-full pt-2 flex flex-col items-center overflow-hidden">
        
        {{-- 1. Background Leaf Decoration (Absolute Center) --}}
        <div class="absolute top-1/2 left-1/2 transform -translate-x-1/5 -translate-y-1/2 z-0 opacity-80 pointer-events-none w-[600px] md:w-[800px]">
            {{-- Make sure this matches your uploaded file name exactly --}}
            <img src="{{ asset('assets/image/home/logo-symbol.png') }}" 
                 alt="Background Pattern" 
                 class="w-full h-auto object-contain">
        </div>

        {{-- 2. Text Content (Centered, High Z-Index) --}}
        <div class="relative z-20 text-center max-w-4xl px-4 mb-8">
            <h1 class="text-3xl md:text-4xl font-semibold text-gray-900 leading-tight mb-4 font-serif">
                Discover your true career path and skills <br class="hidden md:block" />
                with science-backed assessments
            </h1>
            
            <p class="text-gray-700 text-lg md:text-xl mb-8 max-w-2xl mx-auto leading-relaxed">
                Personalized psychometric tests and actionable reports <br class="hidden md:block" />
                for Students (Grade 8–12) and Professionals.
            </p>

            <a href="#plans" class="inline-block bg-white text-gray-900 border border-gray-900 font-semibold px-8 py-3 rounded-full hover:bg-gray-50 transition-transform transform hover:-translate-y-0.5 shadow-sm">
                Explore our plan
            </a>
        </div>

        {{-- 3. Main Illustration (Single Image at Bottom) --}}
        {{-- Flex-grow pushes this to the bottom of the container --}}
        <div class="relative z-10 w-full  mt-auto px-4  flex justify-center items-end">
            <img src="{{ asset('assets/image/home/banner-boy-girl.png') }}" 
                 alt="Students Learning" 
                 class="w-full h-auto max-h-[50vh] object-contain object-bottom">
        </div>

    </section>
@endsection