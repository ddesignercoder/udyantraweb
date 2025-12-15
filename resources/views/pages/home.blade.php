@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- SECTION 1: HERO (Boy & Girl)--}}
    <section class="relative bg-[#9BE1F5] w-full pt-10 md:pt-16 flex flex-col items-center justify-between overflow-hidden min-h-[600px]">
        
        {{-- 1. Background Decoration --}}
        <div class="absolute top-[35%] left-[70%] transform -translate-x-1/2 -translate-y-1/2 z-0 opacity-80 pointer-events-none w-[300px] md:w-[600px]">
            <img src="{{ asset('assets/image/home/logo-symbol.svg') }}" 
                 alt="Background Pattern" 
                 class="w-full h-auto object-contain animate-pulse-slow">
        </div>

        {{-- 2. Text Content --}}
        <div class="relative z-20 text-center max-w-5xl  mb-6 md:mb-0">
            <h1 class="text-2xl md:text-3xl font-semibold text-gray-900 leading-tight mb-4 font-serif">
                Discover your true career path and skills<br class="hidden md:block" />
                with science-backed assessments
            </h1>
            
            <p class="text-gray-800 text-lg md:text-xl mb-8 max-w-2xl mx-auto leading-relaxed">
                Personalized psychometric tests and actionable reports <br class="hidden md:block" />
                for Students (Grade 8–12) and Professionals.
            </p>

            <a href="#plans" 
            class="inline-block bg-white text-gray-900 font-bold text-xl px-12 py-3 rounded-full border-2 border-gray-800 shadow-[-4px_4px_0px_0px_#1f2937] hover:shadow-none hover:translate-x-[-3px] hover:translate-y-[3px] transition-all duration-200">
                Explore our plan
            </a>
        </div>

        {{-- 3. Banner Images --}}
        <div class="relative z-10 w-full max-w-6xl flex justify-center md:justify-between items-end px-0 md:px-8 lg:px-16">
            {{-- BOY: Hidden on mobile, Visible on desktop --}}
            <div class="hidden md:flex md:w-auto md:h-[300px] lg:h-[330px] justify-start items-end">
                <img src="{{ asset('assets/image/home/banner-boy.svg') }}" 
                     alt="Student Boy" 
                     class="w-auto h-full object-contain object-bottom lg:absolute lg:bottom-0 lg:left-0 lg:max-w-[35vw]">
            </div>

            {{-- GIRL: Visible everywhere --}}
            <div class="w-full md:w-auto md:h-[300px] lg:h-[330px] flex justify-center md:justify-end items-end">
                <img src="{{ asset('assets/image/home/banner-girl.svg') }}" 
                     alt="Student Girl" 
                     class="w-3/4 md:w-auto h-auto md:h-full object-contain object-bottom lg:absolute lg:bottom-0 lg:right-0 lg:max-w-[35vw]">
            </div>
        </div>
    </section>

    {{-- SECTION 2: WHAT IS A PSYCHOMETRIC TEST?    --}}
    <section class="bg-white w-full py-16 md:py-24">
        <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 items-start">
                
                {{-- Left Column: Heading --}}
                <div class="md:col-span-4">
                    <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 leading-tight">
                        What is a <br />
                        psychometric test?
                    </h2>
                </div>

                {{-- Right Column: Content --}}
                <div class="md:col-span-8 text-gray-700 space-y-6 text-base md:text-lg leading-relaxed">
                    
                    <p class="font-bold text-gray-900">
                        In a layman language, a psychometric test is a scientific assessment that measures a person's abilities, interests, personality, and strengths.
                    </p>

                    <p>
                        For <span class="font-semibold text-gray-900">students</span>, it helps them understand what they are good at and which subjects or careers will suit them best. This makes stream selection and career planning easier and more accurate.
                    </p>

                    <p>
                        For <span class="font-semibold text-gray-900">professionals</span>, psychometric tests highlight strengths, skills, behavior patterns, and ideal career roles. They help individuals choose the right career direction, switch fields confidently, or grow in their current jobs.
                    </p>

                    <p class="font-bold text-gray-900">
                        Overall, psychometric tests provide clarity and guidance to make better educational and career decisions.
                    </p>

                </div>
            </div>
        </div>
    </section>


{{-- SECTION 3: WHO CAN BENEFIT? --}}
    {{-- Fix: Changed bg-repeat to bg-no-repeat, added bg-cover and bg-center --}}
    <section class="w-full py-16 md:py-24 bg-gray-50 bg-no-repeat bg-cover bg-center" 
             style="background-image: url('{{ asset('assets/image/home/section3-pattern-bg.svg') }}');">
        
        <div class="max-w-7xl mx-auto px-6 lg:px-8 text-center">
            <h2 class="text-3xl md:text-4xl font-serif font-bold text-gray-900 leading-tight mb-12">
                Who can benefit out of these tests?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-24">
                
                {{-- Card 1: School Students --}}
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 md:w-48 md:h-48 rounded-full bg-white flex items-center justify-center shadow-md overflow-hidden mb-6">
                        <img src="{{ asset('assets/image/home/student.svg') }}" 
                             alt="School Student" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="bg-white border-2 border-gray-900 rounded-lg px-6 py-3 font-bold text-gray-900 shadow-sm mb-4">
                        Schools Students (Grade 8–12)
                    </div>
                    
                    <p class="text-gray-600 leading-relaxed max-w-sm">
                        Get clear guidance on the right stream, understand your strengths and interests, and explore career paths that fit you best.
                    </p>
                    
                    <a href="#student-tests" 
                    class="inline-block bg-[#00AAD9] text-white font-bold text-lg px-8 py-3 rounded-full border-2 border-[#00C6D9] shadow-[-2px_2px_0px_0px_#1f2937] hover:shadow-none hover:translate-x-[-3px] hover:translate-y-[3px] transition-all duration-200 mt-6">
                        Explore Student Tests
                    </a>
                </div>

                {{-- Card 2: Professionals --}}
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 md:w-48 md:h-48 rounded-full bg-white flex items-center justify-center shadow-md overflow-hidden mb-6">
                        <img src="{{ asset('assets/image/home/professional.svg') }}" 
                             alt="Professional" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="bg-white border-2 border-gray-900 rounded-lg px-6 py-3 font-bold text-gray-900 shadow-sm mb-4">
                        Professionals (Undergraduates and working individuals)
                    </div>
                    
                    <p class="text-gray-600 leading-relaxed max-w-sm">
                        Understand your skill profile, strengths, personality traits, and align with the right career or growth path.
                    </p>
                    
                    <a href="#professional-tests" 
                    class="inline-block bg-[#00AAD9] text-white font-bold text-lg px-8 py-3 rounded-full border-2 border-[#00C6D9] shadow-[-2px_2px_0px_0px_#1f2937] hover:shadow-none hover:translate-x-[-3px] hover:translate-y-[3px] transition-all duration-200 mt-6">
                        Explore Professional Tests
                    </a>
                </div>

            </div>
        </div>
    </section>

@endsection