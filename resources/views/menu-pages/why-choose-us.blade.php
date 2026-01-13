@extends('layouts.app') 
@section('title', 'Why Choose Us')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')

    {{-- SECTION 1: HERO Section --}}
    <section class="relative bg-gray-100 w-full pt-14 pb:16 lg:pt-20 lg:pb-22">

        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid gap-8 items-center">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center space-y-6 w-full lg:max-w-[992px] mx-auto">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                        Because Every Student Has Unique Skills — We Help You Discover Them
                    </h1>
                    
                    <p class="text-textBlack text-base md:text-lg leading-tight">
                        Udyantra is a smart, easy-to-use skill assessment platform designed specifically for schools to identify strengths, track progress, and support student growth with data-driven insights.
                    </p>

                    <div class="block md:inline-flex centent-start items-center gap-3">
                        <x-button variant="primary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="#">Request a Demo</x-button>
                        <x-button variant="secondary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="{{ route('register') }}">Start Free Trial</x-button>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: Why Choose Us Section --}}
    <section class="relative w-full pt-14 pb:16 lg:pt-20 lg:pb-22">

        <div class="container mx-auto px-4">

            {{-- Header Section --}}
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-3xl md:text-4xl font-sans font-semibold mb-8 md:mb-10">
                    Why Choose Us
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                </div>
                                
            </div>
        </div>

    </section>

   {{-- SECTION 3: Success Stories --}}
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

    {{-- Section 4: FAQs --}}
    <section class="font-sans relative z-0 pt-56 md:pt-70 lg:pt-68 pb-16 lg:py-22">
        <x-faq />
    </section>

    {{-- SECTION 5: Sign Up Today --}}
    
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100 font-sans relative">
        <x-register />
    </section>

@endsection