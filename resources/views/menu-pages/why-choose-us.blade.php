@extends('layouts.app') 
@section('title', 'Why Choose Us')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        /* Fade in and slide up animation */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Fade in and slide from left animation */
        @keyframes fadeInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.8s ease-out forwards;
            opacity: 0;
        }

        .animate-fade-in-left {
            animation: fadeInLeft 0.6s ease-out forwards;
            opacity: 0;
        }

        /* Animation delays */
        .animation-delay-200 { animation-delay: 0.2s; }
        .animation-delay-300 { animation-delay: 0.3s; }
        .animation-delay-400 { animation-delay: 0.4s; }
        .animation-delay-500 { animation-delay: 0.5s; }
        .animation-delay-600 { animation-delay: 0.6s; }
        .animation-delay-700 { animation-delay: 0.7s; }
        .animation-delay-800 { animation-delay: 0.8s; }
        .animation-delay-900 { animation-delay: 0.9s; }
        .animation-delay-1000 { animation-delay: 1.0s; }
    </style>
@endsection

@section('content')

    {{-- SECTION 1: OUR SCIENTIFIC FOUNDATION --}}
    <section class="relative bg-gray-100 w-full pt-6 pb:16 lg:pt-6 lg:pb-18">

        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid gap-8 items-center">
                
                {{-- Text Content --}}
                <div class="text-center space-y-6 w-full lg:max-w-[992px] mx-auto">

                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans animate-fade-in-up">
                        OUR SCIENTIFIC FOUNDATION
                    </h1>

                    <p class="text-textBlack text-base md:text-lg leading-relaxed animate-fade-in-up animation-delay-200">
                        Built on established psychology and global assessment practices
                    </p>
                                        
                    <p class="text-textBlack text-base md:text-lg leading-relaxed animate-fade-in-up animation-delay-300">
                        Udyantra's assessments are grounded in the field of psychometrics, a branch of psychology focused on the objective measurement of human traits and abilities.
                    </p>

                    <div class="text-left space-y-4 mt-6 max-w-3xl mx-auto">
                        <p class="text-textBlack text-base md:text-lg font-semibold text-center mb-6 animate-fade-in-up animation-delay-400">
                            Our assessment design draws from:
                        </p>
                        <div class="space-y-4">
                            <div class="flex items-start gap-4 animate-fade-in-left animation-delay-500 group/item">
                                <div class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary/10 rounded-full transition-all duration-300 group-hover/item:bg-primary/20 group-hover/item:scale-110 group-hover/item:shadow-lg">
                                    <x-lucide-brain class="w-6 h-6 text-primary transition-transform duration-300 group-hover/item:scale-110" />
                                </div>
                                <p class="text-textBlack text-base md:text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary">Trait-based personality theories</p>
                            </div>
                            <div class="flex items-start gap-4 animate-fade-in-left animation-delay-600 group/item">
                                <div class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary/10 rounded-full transition-all duration-300 group-hover/item:bg-primary/20 group-hover/item:scale-110 group-hover/item:shadow-lg">
                                    <x-lucide-gauge class="w-6 h-6 text-primary transition-transform duration-300 group-hover/item:scale-110" />
                                </div>
                                <p class="text-textBlack text-base md:text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary">Aptitude and ability measurement models</p>
                            </div>
                            <div class="flex items-start gap-4 animate-fade-in-left animation-delay-700 group/item">
                                <div class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary/10 rounded-full transition-all duration-300 group-hover/item:bg-primary/20 group-hover/item:scale-110 group-hover/item:shadow-lg">
                                    <x-lucide-compass class="w-6 h-6 text-primary transition-transform duration-300 group-hover/item:scale-110" />
                                </div>
                                <p class="text-textBlack text-base md:text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary">Interest–career alignment frameworks</p>
                            </div>
                            <div class="flex items-start gap-4 animate-fade-in-left animation-delay-800 group/item">
                                <div class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary/10 rounded-full transition-all duration-300 group-hover/item:bg-primary/20 group-hover/item:scale-110 group-hover/item:shadow-lg">
                                    <x-lucide-graduation-cap class="w-6 h-6 text-primary transition-transform duration-300 group-hover/item:scale-110" />
                                </div>
                                <p class="text-textBlack text-base md:text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary">Educational and vocational assessment principles</p>
                            </div>
                            <div class="flex items-start gap-4 animate-fade-in-left animation-delay-900 group/item">
                                <div class="shrink-0 w-12 h-12 flex items-center justify-center bg-primary/10 rounded-full transition-all duration-300 group-hover/item:bg-primary/20 group-hover/item:scale-110 group-hover/item:shadow-lg">
                                    <x-lucide-chart-bar class="w-6 h-6 text-primary transition-transform duration-300 group-hover/item:scale-110" />
                                </div>
                                <p class="text-textBlack text-base md:text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary">Norm-referenced and criterion-based scoring methods</p>
                            </div>
                        </div>
                    </div>

                    <p class="text-textBlack text-base md:text-lg leading-relaxed mt-6 animate-fade-in-up animation-delay-1000">
                        Each question is mapped to a defined psychological construct, ensuring that results are reliable, structured, and meaningful, rather than generic personality labels.
                    </p>

                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: RESEARCH & EVIDENCE BASE --}}
    <section class="relative w-full pt-14 pb:16 lg:pt-18 lg:pb-22">

        <div class="container mx-auto px-4">

            {{-- Header Section --}}
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-3xl md:text-4xl font-sans font-semibold mb-4 animate-fade-in-up">
                    RESEARCH & EVIDENCE BASE
                </h1>
                
                <p class="text-textBlack text-base md:text-lg mb-8 md:mb-4 animate-fade-in-up animation-delay-200">
                    Grounded in established psychological research
                </p>

                <p class="text-textBlack text-base md:text-lg mb-8 max-w-5xl mx-auto animate-fade-in-up animation-delay-300">
                    The principles behind Udyantra's assessments align with widely accepted research and practices used in:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 mb-12">
                        
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-400">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Educational psychology" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Educational psychology</h5>
                    </div>
                    
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-500">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Career guidance and counseling" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Career guidance and counseling</h5>
                    </div>
                    
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-600">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Talent assessment and development" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Talent assessment and development</h5>
                    </div>
                    
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-700">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Vocational and aptitude testing" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Vocational and aptitude testing</h5>
                    </div>
                </div>

                <p class="text-textBlack text-base md:text-lg mb-6 max-w-4xl mx-auto animate-fade-in-up animation-delay-800">
                    Similar psychometric principles are used globally by:
                </p>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                        
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-900">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Educational institutions" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Educational institutions</h5>
                    </div>
                    
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Career counselors and psychologists" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Career counselors and psychologists</h5>
                    </div>
                    
                    <div class="group relative p-6 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
                        <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Corporate hiring and development programs" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Corporate hiring and development programs</h5>
                    </div>
                </div>

                <p class="text-textBlack text-base md:text-lg mt-10 max-w-4xl mx-auto animate-fade-in-up animation-delay-1000">
                    Udyantra adapts these principles for Indian students and professionals, ensuring relevance, clarity, and practical application.
                </p>
                                
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
    
{{--    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100 font-sans relative">
        <x-register />
    </section> --}}

@endsection