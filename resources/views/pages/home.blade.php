@extends('layouts.app')

@section('title', 'Home')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<style>
    body{
        overflow-x: hidden;
    }
    .hide-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .hide-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
    

    </style>   
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

        <div class="max-w-7xl mx-auto px-2 md:px-6 py-8 md:pt-12 md:pb-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 items-center pb-30 sm:pb-36 md:pb-12 lg:pb-18">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center md:text-left space-y-6 w-full md:max-w-xl">
                    <h1 class="text-3xl lg:text-4xl font-semibold text-black leading-tight font-sans">
                        Discover your true career path and skills with 
                        science-backed assessments
                    </h1>
                    
                    <p class="text-textBlack text-lg md:text-xl leading-tight">
                        Personalized psychometric tests and actionable <br> reports for Students (Grade 8–12) and <br> Professionals.
                    </p>

                    <div class="pt-4">
                        <a href="#plans" 
                        class="inline-block bg-white text-black font-medium text-base px-8 py-3 rounded-full border border-borderBase shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200">
                            Explore our plan
                        </a>
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
    <section class="bg-white w-full pb-16 pt-24 md:pt-36 md:pb-16 lg:pt-18 lg:pb-22 relative z-0">
        <div class="w-full lg:max-w-[992px] mx-auto px-4 lg:px-0">
            <div class="flex flex-col items-center text-center space-y-8 lg:mt-32">
                
                {{-- Heading --}}
                <h2 class="text-3xl lg:text-4xl font-semibold text-center text-black font-sans mb-8 md:mb-10">
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
    <section class="w-full py-16 lg:py-22 bg-cover bg-center" 
             style="background-image: url('{{ asset('assets/image/home/section3-pattern-bg.svg') }}');">
        
        <div class="max-w-7xl mx-auto px-2 md:px-6 text-center">
            <h2 class="text-3xl lg:text-4xl font-semibold text-center text-black font-sans mb-8 md:mb-10">
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
                    
                    <div class="bg-white border-1 border-borderArround text-center text-xl rounded-lg px-2 md:px-6 py-1 md:py-3 font-bold text-black shadow-sm mb-4">
                        Schools Students (Grade 8–12)
                    </div>
                    
                    <p class="text-textBlack leading-relaxed max-w-xl">
                        Get clear guidance on the right stream, understand your strengths and interests, and explore career paths that fit you best.
                    </p>
                    
                    <a href="#student-tests" 
                    class="inline-block bg-primary text-white font-medium text-base px-8 py-3 rounded-full border-1 border-borderButn shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 mt-6">
                        Explore Student Tests
                    </a>
                </div>

                {{-- Card 2: Professionals --}}
                <div class="flex flex-col items-center">
                    <div class="w-32 h-32 md:w-48 md:h-48 rounded-full bg-white flex items-center justify-center shadow-lg overflow-hidden mb-6">
                        <img src="{{ asset('assets/image/home/boy.svg') }}" 
                             alt="Professional" 
                             class="w-full h-full object-cover">
                    </div>
                    
                    <div class="bg-white border-1 border-borderArround text-center text-xl rounded-lg px-2 md:px-6 py-1 md:py-3 font-bold md:font-bold text-black shadow-sm mb-4">
                        Professionals (Undergraduates and working individuals)
                    </div>
                    
                    <p class="text-textBlack leading-relaxed max-w-xl">
                        Understand your skill profile, strengths, personality traits, and align with the right career or growth path.
                    </p>
                    
                    <a href="#professional-tests" 
                       class="inline-block bg-primary text-white font-medium text-base px-8 py-3 rounded-full border-1 border-borderButn shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 mt-6">
                        Explore Professional Tests
                    </a>
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
            
            <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-0 text-center w-full h-full flex flex-col justify-center md:block">
                
                {{-- Heading --}}
                <h2 class="text-3xl lg:text-4xl font-semibold text-center text-black font-sans mb-8 md:mb-10">
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
                        <p class="text-black font-normal text-xl max-w-2xl mx-auto mb-4 md:mb-6">
                            <span class="font-bold block mb-1">Take the assessment online</span>
                            from any device
                        </p>
                        {{-- FIX 3: Reduced max-height to 30vh on mobile to prevent bottom clipping --}}
                        <img src="{{ asset('assets/image/home/hero-devices.svg') }}" 
                            alt="Step 1 Dashboard" 
                            class="w-full h-auto max-h-[40vh] md:max-h-[70vh] object-contain drop-shadow-xl select-none">
                    </div>

                    {{-- STEP 2 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black font-normal text-xl max-w-2xl mx-auto mb-4 md:mb-6">
                            <span class="font-bold block mb-1">Receive a detailed report instantly</span>
                            highlighting strengths and career matches
                        </p>
                        <img src="{{ asset('assets/image/home/section4-image.svg') }}" 
                            alt="Step 2 Recommendations" 
                            class="w-full h-auto max-h-[40vh] md:max-h-[60vh] object-contain select-none">
                    </div>

                    {{-- STEP 3 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black font-normal text-xl max-w-2xl mx-auto mb-4 md:mb-6">
                            <span class="font-bold block mb-1">Plan your next steps</span>
                            with clear recommendations
                        </p>
                        <img src="{{ asset('assets/image/home/section4-step3.svg') }}" 
                            alt="Step 3 Devices" 
                            class="w-full h-auto max-h-[40vh] md:max-h-[60vh] object-contain drop-shadow-xl select-none">
                    </div>

                </div>  

            </div>
            {{-- Static Action Buttons --}}
                <div class="flex flex-col md:flex-row justify-center items-center gap-4 md:gap-6 mt-6  shrink-0 pb-2">
                    <a href="#demo-tests" class="inline-block bg-primary text-white font-medium text-base px-10 py-3 md:py-4 rounded-full border-1 border-borderButn shadow-hard hover:shadow-none hover:-translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 w-auto text-center">
                        Try Demo Tests
                    </a>
                    <a href="#sample-report" class="inline-block bg-white text-textBlack font-medium text-base px-10 py-3 md:py-4 rounded-full border-1 border-borderBase shadow-hard hover:shadow-none hover:-translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 w-auto text-center">
                        Download Sample Report
                    </a>
                </div>
        </div>
    </section>

    {{-- SECTION 5: Success Stories --}}
    <section class=" py-16 lg:py-22 bg-lightgray font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-6">

            <h2 class="text-3xl lg:text-4xl font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Success stories from our customers
            </h2>

            {{-- MOVING CONTENT STORIES --}}
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-10 relative -mb-60 md:-mb-70 fade-sides">
                
                {{-- Carousel Logic --}}
                <div x-data="{ 
                        scrollContainer() { return this.$refs.container },
                        getScrollWidth() { return this.$refs.container.firstElementChild.getBoundingClientRect().width + 24 },
                        scrollNext() { this.scrollContainer().scrollBy({ left: this.getScrollWidth(), behavior: 'smooth' }) },
                        scrollPrev() { this.scrollContainer().scrollBy({ left: -this.getScrollWidth(), behavior: 'smooth' }) }
                    }" class="relative">

                    <div x-ref="container" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 hide-scrollbar">
                        @php
                            $stories = [
                                ['name' => 'Erin Booth', 'role' => 'Virtual Assistant Coach', 'img' => '5', 'title' => 'Get Full Control', 'quote' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley..."],
                                ['name' => 'Razvan Ciobanu', 'role' => 'Voxyde', 'img' => '3', 'title' => 'Peace of Mind', 'quote' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley..."],
                                ['name' => 'Dan George', 'role' => 'FlightInsight', 'img' => '11', 'title' => '10,000+ Students', 'quote' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley..."],
                                ['name' => 'Rony Pinto', 'role' => 'Virtual Assistant Coach', 'img' => '5', 'title' => 'Get Full Control', 'quote' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry...'],
                            ];
                        @endphp

                        @foreach($stories as $story)
                            <div class="w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1rem)] flex-none border border-lightgray rounded-xl p-6 snap-center flex flex-col bg-white">
                                <div class="flex items-center mb-4">
                                    <img src="https://i.pravatar.cc/150?img={{ $story['img'] }}" 
                                        alt="{{ $story['name'] }}" 
                                        class="w-12 h-12 rounded-full object-cover mr-3 bg-gray-100">
                                    <div>
                                        <h4 class="font-bold text-textBlack text-sm">{{ $story['name'] }}</h4>
                                        <h5 class="text-xs text-black opacity-[0.7]">{{ $story['role'] }}</h5>
                                    </div>
                                </div>
                                <h5 class="text-base font-bold text-textBlack mb-2">{{ $story['title'] }}</h5>
                                <p class="text-black opacity-[0.7] text-sm leading-relaxed mb-6 grow line-clamp-4">"{{ $story['quote'] }}"</p>
                                <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                    Explore school <span class="ml-1">&rarr;</span>
                                </a>
                            </div>
                        @endforeach
                    </div>

                    {{-- Controls --}}
                    <div class="flex justify-center gap-4 mt-4 md:mt-8">
                        <button @click="scrollPrev()" class="w-8 h-8 md:w-12 md:h-12 rounded-full bg-black text-white flex items-center justify-center leading-none  hover:bg-gray-800 transition shadow-lg ">
                            <span class="relative top-[-2px]">&larr;</span>
                        </button>
                        <button @click="scrollNext()" class="w-8 h-8 md:w-12 md:h-12 rounded-full bg-black text-white flex items-center justify-center leading-none  hover:bg-gray-800 transition shadow-lg">
                            <span class="relative top-[-2px]">&rarr;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

{{-- Section 6: FAQ --}}
    <section class="pt-58 lg:pt-70 pb-16 lg:py-22 bg-white font-sans relative z-0">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl lg:text-4xl font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Frequently asked questions
            </h2>
            
            {{-- FAQ Items --}}
            @php
                $faqs = [
                    ['question' => 'How accurate are the tests?', 'answer' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
                    ['question' => 'Are results confidential?', 'answer' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
                    ['question' => 'How long does each test take?', 'answer' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
                ];
            @endphp

            <div class="space-y-4" x-data="{ active: null }">
                @foreach($faqs as $faq)
                    <div class="transition-all duration-300">
                        <button @click="active = (active === {{ $loop->index }} ? null : {{ $loop->index }})" class="w-full px-8 py-4 md:py-5 flex items-center justify-between text-left focus:outline-none cursor-pointer bg-lightgray rounded-4xl">
                            <span class="text-lg font-medium text-black">{{ $faq['question'] }}</span>
                            
                            <span class="ml-4 shrink-0 relative w-5 h-5">
                                <svg x-show="active !== {{ $loop->index }}" class="w-5 h-5 text-black absolute inset-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                <svg x-show="active === {{ $loop->index }}" x-cloak class="w-5 h-5 text-black absolute inset-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </span>
                        </button>
                        <div x-show="active === {{ $loop->index }}" x-collapse x-cloak class="px-8 pb-6 text-black text-base fw-normal mt-5 leading-relaxed">
                            {{ $faq['answer'] }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

@endsection