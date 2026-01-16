@extends('layouts.app')

@section('title', 'Home')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
 
@endsection

@section('content')
    {{-- SECTION 1: HERO Section --}}
    <section class="relative bg-secondary w-full">
        
        {{-- Background Decoration (Leaf) --}}
        <div class="absolute bottom-[0%] right-[0%] opacity-60 pointer-events-none w-[300px] md:w-[460px] lg:w-[560px] overflow-hidden">
            <img src="{{ asset('assets/image/home/logo-symbol.svg') }}" 
                alt="Background Pattern" 
                class="w-full h-auto object-contain">
        </div>

        <div class="max-w-7xl mx-auto px-4 md:px-6 pt-16 pb-0 md:pt-16 md:pb-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center pb-30 sm:pb-36 md:pb-12 lg:pb-18">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center md:text-left space-y-6 w-full md:max-w-xl">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                        Discover your true career path and skills with 
                        science-backed assessments
                    </h1>
                    
                    <p class="text-textBlack text-lg md:text-xl leading-tight">
                        Personalized psychometric tests and actionable <br> reports for Students (Grade 8–12) and <br> Professionals.
                    </p>

                    <div class="pt-0">
                        <x-button variant="secondary" as="a" class="mt-6" href="{{ route('udyantra-package') }}">Explore our plan</x-button>
                    </div>
                </div>

                {{-- 3. Right Side: OverlapDevice Mockup Image --}}
                <div class="text-center">
                    
                    <img src="{{ asset('assets/image/home/hero-devices.svg') }}" 
                        alt="Dashboard Preview" 
                        class="w-11/12 md:w-xl lg:w-3xl xl:w-4xl absolute right-[4%] bottom-[-10%] md:bottom-[-18%] lg:bottom-[-26%] md:right-[-5.5%] lg:right-[-6%] xl:right-[-8%]">
                
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: WHAT IS A PSYCHOMETRIC TEST? --}}
    <section class="bg-white w-full px-4 md:px-6 pb-16 pt-24 md:pt-36 md:pb-16 lg:pt-18 lg:pb-22 relative z-0">
        <div class="w-full lg:max-w-[992px] mx-auto">
            <div class="flex flex-col items-center text-center space-y-8 lg:mt-32">
                
                {{-- Heading --}}
                <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                    What is a psychometric test?
                </h2>

                {{-- Lead Text--}}
                <div class="space-y-5 w-full text-base text-textBlack ">
                    <p>
                        A <span class="font-semibold">psychometric test</span> is a scientific assessment that measures an individual’s abilities, personality, interests, and behaviour.
                        It helps understand strengths, preferences, and potential beyond academic scores or resumes.
                    </p>
                    <p>
                        These tests support career guidance, subject selection, role fitment, and personal development by providing objective, unbiased insights. When interpreted by experts, psychometric assessments enable confident decision-making and meaningful growth.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- SECTION 3: WHO CAN BENEFIT? --}}
    <section class="py-16 lg:py-22 bg-cover bg-center" style="background-image: url('{{ asset('assets/image/home/section3-pattern-bg.svg') }}');">
        
        <div class="max-w-7xl mx-auto px-2 md:px-4 text-center">
            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Who can benefit out of these tests?
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 lg:gap-24">
                
                {{-- Card 1: School Students --}}
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 md:w-48 md:h-48 rounded-full bg-white flex items-center justify-center shadow-lg overflow-hidden mb-6">
                        <img src="{{ asset('assets/image/home/girl.svg') }}" 
                             alt="School Student" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="bg-white border border-borderArround text-center text-lg md:text-xl rounded-lg px-3 md:px-6 py-3 md:py-3 font-bold text-black shadow-sm mb-4">
                        Schools Students (Grade 8–12)
                    </div>
                    
                    <p class="text-textBlack leading-relaxed max-w-xl">
                        Get clear guidance on the right stream, understand your strengths and interests, and explore career paths that fit you best.
                    </p>
                    
                    <x-button as="a" class="mt-6" href="#student-tests">Explore Student Tests</x-button>
                </div>

                {{-- Card 2: Professionals --}}
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 md:w-48 md:h-48 rounded-full bg-white flex items-center justify-center shadow-lg overflow-hidden mb-6">
                        <img src="{{ asset('assets/image/home/boy.svg') }}" 
                             alt="Professional" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="bg-white border border-borderArround text-center text-lg md:text-xl rounded-lg px-3 md:px-6 py-3 md:py-3 font-bold md:font-bold text-black shadow-sm mb-4">
                        Professionals (Undergraduates and working individuals)
                    </div>
                    
                    <p class="text-textBlack leading-relaxed max-w-xl">
                        Understand your skill profile, strengths, personality traits, and align with the right career or growth path.
                    </p>
                    <x-button as="a" class="mt-6" href="#professional-tests">Explore Professional Tests</x-button>
                    
                </div>

            </div>
        </div>
    </section>
    {{-- SECTION 4: HOW IT WORKS --}}
    <section x-data="{ 
                scrollPercentage: 0, 
                calculateScroll() { 
                const rect = this.$el.getBoundingClientRect();
                const distanceFromTop = -rect.top;
                const totalScrollDistance = rect.height - window.innerHeight;
                let percent = distanceFromTop / totalScrollDistance;
                this.scrollPercentage = Math.max(0, Math.min(1, percent)); }
            }" 
            @scroll.window="calculateScroll()"
            class="relative h-[300vh] py-16 lg:py-22 bg-white z-10"> 

        <div class="sticky top-0 h-auto flex flex-col justify-start md:justify-center overflow-hidden bg-white z-20">
            
            <div class="max-w-7xl mx-auto px-2 md:px-4 md:py-0 text-center w-full h-full flex flex-col justify-center md:block">
                
                {{-- Heading --}}
                <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                    How it works?
                </h2>

                {{-- PROGRESS BAR --}}
                <div class="w-full max-w-6xl mx-auto h-1 bg-hrGray mb-6 md:mb-8 relative overflow-hidden rounded-full shrink-0">
                    <div class="absolute top-0 left-0 h-full bg-black rounded-full transition-all duration-75 ease-linear will-change-transform"
                        :style="`width: ${33.33 + (scrollPercentage * 66.66)}%`">
                    </div>
                </div>

                {{-- MOVING CONTENT TRACK --}}
                <div class="flex w-[300%] transition-transform duration-75 ease-linear will-change-transform grow-0"
                    :style="`transform: translateX(-${scrollPercentage * 66.66}%)`">

                    {{-- STEP 1 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black font-normal text-lg md:text-xl w-full mx-auto mb-4 md:mb-6">
                            <span class="font-bold block mb-1">Take the assessment online</span>
                            from any device
                        </p>
                        {{-- FIX 3: Reduced max-height to 30vh on mobile to prevent bottom clipping --}}
                        <img src="{{ asset('assets/image/home/hero-devices.svg') }}" 
                            alt="Step 1 Dashboard" 
                            class="w-full h-auto max-h-[50vh] md:max-h-[70vh] object-contain drop-shadow-xl select-none">
                    </div>

                    {{-- STEP 2 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black font-normal text-lg md:text-xl w-full mx-auto mb-4 md:mb-6">
                            <span class="font-bold block mb-1">Receive a detailed report instantly</span>
                            highlighting strengths and career matches
                        </p>
                        <img src="{{ asset('assets/image/home/section4-image.svg') }}" 
                            alt="Step 2 Recommendations" 
                            class="w-full h-auto max-h-[50vh] md:max-h-[60vh] object-contain select-none">
                    </div>

                    {{-- STEP 3 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black font-normal text-lg md:text-xl w-full mx-auto mb-4 md:mb-6">
                            <span class="font-bold block mb-1">Plan your next steps</span>
                            with clear recommendations
                        </p>
                        <img src="{{ asset('assets/image/home/section4-step3.svg') }}" 
                            alt="Step 3 Devices" 
                            class="w-full h-auto max-h-[50vh] md:max-h-[60vh] object-contain drop-shadow-xl select-none">
                    </div>

                </div>  

            </div>
            {{-- Static Action Buttons --}}
                <div class="flex flex-col md:flex-row justify-center items-center gap-4 md:gap-6 mt-6  shrink-0 pb-2">
                    <x-button as="a" class="w-9/12 md:w-4/12 lg:w-70" href="#">Try Demo Tests</x-button>
                    <x-button variant="secondary" as="a" class="w-9/12 md:w-4/12 lg:w-70 px-4 py-3 md:py-4" href="#sample-report">Download Sample Report</x-button>
                </div>
        </div>
    </section>

    {{-- SECTION 5: Success Stories --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-lightgray font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-4">

            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Success stories from our customers
            </h2>

            {{-- MOVING CONTENT STORIES --}}
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-10 relative -mb-60 md:-mb-70 fade-sides">
                
                {{-- Carousel Logic --}}
                <x-testimonials />

            </div>
        </div>
    </section>

{{-- Section 6: FAQ --}}
    <section class="pt-56 lg:pt-68 pb-16 lg:py-22 bg-white font-sans relative z-0">                           
        <x-faq />
    </section>

@endsection