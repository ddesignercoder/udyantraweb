@extends('layouts.app') 
@section('title', 'What We Focus On')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@section('content')

    {{-- SECTION 1: HERO Section --}}
    <section class="relative bg-linear-to-br from-cyan-50 via-teal-50 to-emerald-50 w-full pt-14 pb-16 lg:pt-20 lg:pb-22">

        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid gap-8 items-center">
                
                {{-- Text Content --}}
                <div class="text-center space-y-6 w-full lg:max-w-[992px] mx-auto">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                        THE RISEC FRAMEWORK
                    </h1>
                    
                    <p class="text-textBlack text-base md:text-lg leading-relaxed">
                        How Udyantra connects who you are to where you can grow
                    </p>

                    <p class="text-gray-700 text-base md:text-lg leading-relaxed max-w-4xl mx-auto">
                        Udyantra assessments are built using the <strong>RISEC Framework</strong>, a structured model that evaluates an individual across five critical dimensions:
                    </p>

                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: RISEC Framework Components --}}
    <section class="relative w-full pt-14 pb-16 lg:pt-20 lg:pb-22">

        <div class="container mx-auto px-4">

            {{-- Header Section --}}
            <div class="container mx-auto px-4 text-center mb-12">
                <h2 class="text-3xl md:text-4xl font-sans font-semibold mb-4">
                    The Five Dimensions
                </h2>
                <p class="text-gray-600 text-base md:text-lg max-w-3xl mx-auto">
                    This integrated approach ensures that recommendations are holistic, balanced, and practical.
                </p>
            </div>

            {{-- RISEC Cards Grid --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto">
                
                {{-- R - Personality Traits --}}
                <div class="group relative p-6 flex flex-col bg-white rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-primary">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 bg-linear-to-br from-primary to-secondary rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">Personality Traits</h3>
                    <p class="text-gray-700 text-base leading-relaxed">
                        Measures stable personality characteristics that influence behaviour, communication style, decision-making, and work preferences.
                    </p>
                </div>

                {{-- I - Interests & Motivations --}}
                <div class="group relative p-6 flex flex-col bg-white rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-secondary">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 bg-linear-to-br from-secondary to-primary rounded-full">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">Interests & Motivations</h3>
                    <p class="text-gray-700 text-base leading-relaxed">
                        Identifies areas that naturally engage curiosity and long-term motivation, helping avoid burnout and misaligned choices.
                    </p>
                </div>

                {{-- S - Skills & Strengths --}}
                <div class="group relative p-6 flex flex-col bg-white rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-primary">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 bg-linear-to-br from-primary to-secondary rounded-full">
                        <svg class="w-8 h-8 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">Skills & Strengths</h3>
                    <p class="text-gray-700 text-base leading-relaxed">
                        Assesses cognitive abilities, learned skills, and natural aptitudes relevant to academic and career success.
                    </p>
                </div>

                {{-- E - Orientation & Environment Fit --}}
                <div class="group relative p-6 flex flex-col bg-white rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-secondary">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 bg-linear-to-br from-secondary to-primary rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">Orientation & Environment Fit</h3>
                    <p class="text-gray-700 text-base leading-relaxed">
                        Evaluates how an individual aligns with different learning styles, work environments, and role expectations.
                    </p>
                </div>

                {{-- C - Career Mapping --}}
                <div class="group relative p-6 flex flex-col bg-white rounded-2xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-primary md:col-span-2 lg:col-span-1">
                    <div class="flex items-center justify-center w-16 h-16 mb-4 bg-linear-to-br from-primary to-secondary rounded-full">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-black mb-3">Career Mapping</h3>
                    <p class="text-gray-700 text-base leading-relaxed">
                        Integrates all dimensions to suggest realistic, aligned, and future-ready career pathways and development directions.
                    </p>
                </div>

            </div>
                            
        </div>

    </section>

    {{-- SECTION 3: Development Process --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-lightgray font-sans relative">
        <div class="max-w-7xl mx-auto px-4 md:px-6">

            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-4">
                STRUCTURED & SCIENTIFIC DEVELOPMENT PROCESS
            </h2>

            <p class="text-center text-gray-600 text-base md:text-lg mb-12 max-w-3xl mx-auto">
                Every assessment is built with precision, validated through research, and designed to deliver actionable insights.
            </p>

            {{-- Process Steps --}}
            <div class="bg-white rounded-2xl shadow-xl p-6 md:p-10 relative">
                
                <div class="space-y-8">
                    
                    {{-- Step 1 --}}
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl">
                            1
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-black mb-2">Construct Definition</h3>
                            <p class="text-gray-700 text-base leading-relaxed">
                                Each section is based on clearly defined psychological constructs such as aptitude, personality traits, interests, and orientation.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200"></div>

                    {{-- Step 2 --}}
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl">
                            2
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-black mb-2">Question Design</h3>
                            <p class="text-gray-700 text-base leading-relaxed">
                                Questions use validated formats such as Likert scales, situational judgment items, and aptitude-based patterns.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200"></div>

                    {{-- Step 3 --}}
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl">
                            3
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-black mb-2">Bias Reduction</h3>
                            <p class="text-gray-700 text-base leading-relaxed">
                                Items are reviewed to minimize cultural, academic, and gender bias.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200"></div>

                    {{-- Step 4 --}}
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl">
                            4
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-black mb-2">Scoring & Scaling</h3>
                            <p class="text-gray-700 text-base leading-relaxed">
                                Responses are converted into standardized scores for objective comparison and interpretation.
                            </p>
                        </div>
                    </div>

                    {{-- Divider --}}
                    <div class="border-t border-gray-200"></div>

                    {{-- Step 5 --}}
                    <div class="flex flex-col md:flex-row gap-6 items-start">
                        <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl">
                            5
                        </div>
                        <div class="flex-1">
                            <h3 class="text-xl font-bold text-black mb-2">Expert Interpretation Framework</h3>
                            <p class="text-gray-700 text-base leading-relaxed">
                                Results are translated into actionable insights using structured interpretation models — not random AI outputs.
                            </p>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 4: Success Stories --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-white font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-4">

            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Success stories from our customers
            </h2>

            {{-- MOVING CONTENT STORIES --}}
            <div class="bg-lightgray rounded-xl shadow-xl p-4 md:p-10 relative -mb-60 md:-mb-70 fade-sides">
            
            {{-- Carousel Logic --}}
                <x-testimonials />

            </div>
        </div>
    </section>

    {{-- Section 5: FAQs --}}
    <section class="font-sans relative z-0 pt-56 md:pt-70 lg:pt-68 pb-16 lg:py-22">
        <x-faq />
    </section>

    {{-- SECTION 6: Sign Up Today --}}
    <!-- <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100 font-sans relative">
        <x-register />
    </section> -->

@endsection
