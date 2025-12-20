@extends('layouts.app')

@section('title', 'Home')
@section('css')
<style>

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
    <section class="relative bg-secondary w-full z-10 overflow-hidden md:overflow-visible">
        
        {{-- Background Decoration (Leaf) --}}
        <div class="absolute bottom-[40%] right-[30%] transform translate-x-1/2 translate-y-1/2 z-0 opacity-40 pointer-events-none w-[500px] lg:w-[700px] overflow-hidden">
            <img src="{{ asset('assets/image/home/logo-symbol.svg') }}" 
                alt="Background Pattern" 
                class="w-full h-auto object-contain">
        </div>

        <div class="max-w-7xl mx-auto px-2 md:px-6 py-8 md:py-12 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center lg:pb-20">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center md:text-left space-y-6 max-w-xl">
                    <h1 class="text-xl md:text-3xl font-semibold text-black leading-tight font-sans">
                        Discover your true career path and skills with 
                        science-backed assessments
                    </h1>
                    
                    <p class="text-textBlack text-lg md:text-xl  leading-tight">
                        Personalized psychometric tests and actionable <br> reports for Students (Grade 8–12) and <br> Professionals.
                    </p>

                    <div class="pt-4">
                        <a href="#plans" 
                        class="inline-block bg-white text-black font-bold text-base md:text-lg px-8 py-3 rounded-full border border-borderBase shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200">
                            Explore our plan
                        </a>
                    </div>
                </div>

                {{-- 3. Right Side: OverlapDevice Mockup Image --}}
                <div class="relative lg:absolute bottom-7 md:bottom-0 right-[-8%] md:right-[-14.5%]  lg:w-[65%] flex justify-center md:justify-end z-20 
                            transform translate-y-[40%] md:translate-y-[30%]  md:translate-x-[0%]">
                    
                    <img src="{{ asset('assets/image/home/hero-devices.svg') }}" 
                        alt="Dashboard Preview" 
                        class="w-full max-w-2xl md:max-w-5xl h-auto drop-shadow-2xl object-contain">
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: WHAT IS A PSYCHOMETRIC TEST? --}}
    <section class="bg-white w-full py-16 md:py-24 relative z-0">
        <div class="max-w-7xl mx-auto px-2 md:px-6">
            <div class="flex flex-col items-center text-center space-y-8 lg:mt-32">
                
                {{-- Heading --}}
                <h2 class="text-xl md:text-3xl font-semibold text-black font-sans mb-2">
                    What is a psychometric test?
                </h2>

                {{-- Lead Text--}}
                <div class="space-y-4 max-w-5xl text-base text-textBlack ">
                    <p>
                        A <span class="font-semibold">psychometric test</span> is a scientific assessment that measures an individual’s abilities, personality, interests, and behaviour. <br>
                        It helps understand strengths, preferences, and potential beyond academic scores or resumes.
                    </p>
                </div>

                {{-- Body Text--}}
                <div class="max-w-5xl text-base md:text-base text-textBlack ">
                    <p>
                        These tests support career guidance, subject selection, role fitment, and personal development by providing objective, unbiased insights. When interpreted by experts, psychometric assessments enable confident decision-making and meaningful growth.
                    </p>
                </div>

            </div>
        </div>
    </section>


    {{-- SECTION 3: WHO CAN BENEFIT? --}}
    <section class="w-full py-16 md:py-24 bg-cover bg-center" 
             style="background-image: url('{{ asset('assets/image/home/section3-pattern-bg.svg') }}');">
        
        <div class="max-w-7xl mx-auto px-2 md:px-6 text-center">
            <h2 class="text-xl md:text-4xl font-semibold font-sans  text-black leading-tight mb-12">
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
                    
                    <div class="bg-white border-2 border-borderAround text-center rounded-lg px-2 md:px-6 py-1 md:py-3 font-semibold md:font-bold text-black shadow-sm mb-4">
                        Schools Students (Grade 8–12)
                    </div>
                    
                    <p class="text-textBlack leading-relaxed max-w-xl">
                        Get clear guidance on the right stream, understand your strengths and interests, and explore career paths that fit you best.
                    </p>
                    
                    <a href="#student-tests" 
                    class="inline-block bg-primary text-white font-bold text-lg px-8 py-3 rounded-full border-2 border-secondary shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 mt-6">
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
                    
                    <div class="bg-white border-2 border-borderAround text-center rounded-lg px-2 md:px-6 py-1 md:py-3 font-semibold md:font-bold text-black shadow-sm mb-4">
                        Professionals (Undergraduates and working individuals)
                    </div>
                    
                    <p class="text-textBlack leading-relaxed max-w-xl">
                        Understand your skill profile, strengths, personality traits, and align with the right career or growth path.
                    </p>
                    
                    <a href="#professional-tests" 
                       class="inline-block bg-primary text-white font-bold text-lg px-8 py-3 rounded-full border-2 border-secondary shadow-hard hover:shadow-none hover:translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 mt-6">
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
                    this.scrollPercentage = Math.max(0, Math.min(1, percent));
                }
            }" 
            @scroll.window="calculateScroll()"
            class="relative h-[300vh] bg-white z-10"> 

        <div class="sticky top-0 h-dvh flex flex-col justify-start md:justify-center pt-16 md:pt-0 pb-10 md:pb-0 overflow-hidden bg-white z-20">
            
            <div class="max-w-7xl mx-auto px-6 lg:px-8 md:py-8 text-center w-full h-full flex flex-col justify-center md:block">
                
                {{-- Heading --}}
                <h2 class="text-2xl md:text-xxl font-serif font-bold text-black leading-tight mb-4 md:mb-6 shrink-0">
                    How it works?
                </h2>

                {{-- PROGRESS BAR --}}
                <div class="w-full max-w-6xl mx-auto h-1 bg-hrGray-200 mb-6 md:mb-8 relative overflow-hidden rounded-full shrink-0">
                    <div class="absolute top-0 left-0 h-full bg-black rounded-full transition-all duration-75 ease-linear will-change-transform"
                        :style="`width: ${33.33 + (scrollPercentage * 66.66)}%`">
                    </div>
                </div>

                {{-- MOVING CONTENT TRACK --}}
                <div class="flex w-[300%] transition-transform duration-75 ease-linear will-change-transform grow-0"
                    :style="`transform: translateX(-${scrollPercentage * 66.66}%)`">

                    {{-- STEP 1 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black text-lg md:text-xl max-w-2xl mx-auto leading-relaxed mb-4 md:mb-6">
                            <span class="font-bold block mb-2 text-xl md:text-3xl">Take the assessment online</span>
                            from any device
                        </p>
                        {{-- FIX 3: Reduced max-height to 30vh on mobile to prevent bottom clipping --}}
                        <img src="{{ asset('assets/image/home/hero-devices.svg') }}" 
                            alt="Step 1 Dashboard" 
                            class="w-full h-auto max-h-[30vh] md:max-h-[50vh] object-contain drop-shadow-xl select-none">
                    </div>

                    {{-- STEP 2 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black text-lg md:text-xl max-w-2xl mx-auto leading-relaxed mb-4 md:mb-6">
                            <span class="font-bold block mb-2 text-xl md:text-3xl">Receive a detailed report instantly</span>
                            highlighting strengths and career matches
                        </p>
                        <img src="{{ asset('assets/image/home/section4-image.svg') }}" 
                            alt="Step 2 Recommendations" 
                            class="w-full h-auto max-h-[30vh] md:max-h-[50vh] object-contain select-none">
                    </div>

                    {{-- STEP 3 --}}
                    <div class="w-1/3 shrink-0 flex flex-col items-center justify-center px-4">
                        <p class="text-black text-lg md:text-xl max-w-2xl mx-auto leading-relaxed mb-4 md:mb-6">
                            <span class="font-bold block mb-2 text-xl md:text-3xl">Plan your next steps</span>
                            with clear recommendations
                        </p>
                        <img src="{{ asset('assets/image/home/section4-step3.svg') }}" 
                            alt="Step 3 Devices" 
                            class="w-full h-auto max-h-[30vh] md:max-h-[50vh] object-contain drop-shadow-xl select-none">
                    </div>

                </div> 

                {{-- Static Action Buttons --}}
                <div class="flex flex-col md:flex-row justify-center items-center gap-4 md:gap-6 mt-6  shrink-0">
                    <a href="#demo-tests" class="inline-block bg-primary text-white font-bold text-base px-10 py-3 md:py-4 rounded-full border-2 border-secondary shadow-hard hover:shadow-none hover:-translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 w-full md:w-auto text-center">
                        Try Demo Tests
                    </a>
                    <a href="#sample-report" class="inline-block bg-white text-textBlack font-bold text-base px-10 py-3 md:py-4 rounded-full border-2 border-borderBase shadow-hard hover:shadow-none hover:-translate-x-0.5 hover:translate-y-0.5 transition-all duration-200 w-full md:w-auto text-center">
                        Download Sample Report
                    </a>
                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 5: Success Stories (Floating Carousel) --}}
    <section class="py-20 bg-gray-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <h2 class="text-3xl md:text-5xl font-serif text-center text-gray-900 mb-12">
                Success stories from our customers
            </h2>

            <div class="bg-white rounded-4xl shadow-xl p-8 md:p-12 relative">
                
                <div x-data="{ 
                        scrollAmount: 0,
                        scrollContainer() { return this.$refs.container },
                        scrollNext() { this.scrollContainer().scrollBy({ left: 340, behavior: 'smooth' }) },
                        scrollPrev() { this.scrollContainer().scrollBy({ left: -340, behavior: 'smooth' }) }
                    }" class="relative">

                    <div x-ref="container" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 hide-scrollbar">
                        
                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=5" alt="Erin Booth" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Erin Booth</h4>
                                    <p class="text-xs text-gray-500">Virtual Assistant Coach</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">Get Full Control</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "You should never have anyone dictating the prices you charge for your content. With Teachable, you get full control..."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=3" alt="Razvan Ciobanu" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Razvan Ciobanu</h4>
                                    <p class="text-xs text-gray-500">Voxyde</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">Peace of Mind</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "Teachable is consistently monitored and delivers excellent uptime. As an instructor, that peace of mind is invaluable..."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=11" alt="Dan George" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Dan George</h4>
                                    <p class="text-xs text-gray-500">FlightInsight</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">10,000+ Students</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "Teachable gave me the structure to go beyond the classroom. What started as a few dozen students has grown into..."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=32" alt="Sarah Jenkins" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Sarah Jenkins</h4>
                                    <p class="text-xs text-gray-500">Career Counselor</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">Incredible Clarity</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "The psychometric reports provided insights I couldn't have found on my own. It completely changed my career trajectory."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=60" alt="Michael Chen" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Michael Chen</h4>
                                    <p class="text-xs text-gray-500">Student, Class 12</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">Stream Selection</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "I was confused between Engineering and Design. The aptitude test highlighted my spatial skills, making the choice obvious."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=44" alt="Anita Roy" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">Anita Roy</h4>
                                    <p class="text-xs text-gray-500">HR Manager</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">Hiring Made Easy</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "We use these assessments for internal hiring. It saves us hours of interview time by filtering the best candidates first."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                        <div class="min-w-[300px] md:min-w-[340px] border border-gray-100 rounded-xl p-6 snap-center flex flex-col bg-white">
                            <div class="flex items-center mb-4">
                                <img src="https://i.pravatar.cc/150?img=12" alt="David Miller" class="w-12 h-12 rounded-full object-cover mr-3">
                                <div>
                                    <h4 class="font-bold text-gray-900 text-sm">David Miller</h4>
                                    <p class="text-xs text-gray-500">Freelancer</p>
                                </div>
                            </div>
                            <h5 class="text-base font-bold text-gray-800 mb-2">Found My Niche</h5>
                            <p class="text-gray-600 text-sm leading-relaxed mb-6 grow">
                                "I struggled to find a niche for years. The personality test showed my strengths in analytical thinking, which led me to data science."
                            </p>
                            <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                                Explore school <span class="ml-1">&rarr;</span>
                            </a>
                        </div>

                    </div>

                    <div class="flex justify-center gap-4 mt-8">
                        <button @click="scrollPrev()" class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 transition shadow-lg">
                            &larr;
                        </button>
                        <button @click="scrollNext()" class="w-12 h-12 rounded-full bg-black text-white flex items-center justify-center hover:bg-gray-800 transition shadow-lg">
                            &rarr;
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- Section 6: FAQ (Pill Accordion) --}}
    <section class="py-20 bg-white font-sans">
        <div class="max-w-3xl mx-auto px-4">
            <h2 class="text-3xl md:text-5xl font-serif text-center text-gray-900 mb-16">
                Frequently asked questions
            </h2>

            <div class="space-y-4">
                
                <div x-data="{ open: false }" class="bg-gray-100 rounded-2xl transition-all duration-300">
                    <button @click="open = !open" class="w-full px-8 py-5 flex items-center justify-between text-left focus:outline-none cursor-pointer">
                        <span class="text-lg font-medium text-gray-900">How accurate are the tests?</span>
                        <span class="ml-4 shrink-0">
                            <svg x-show="!open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <svg x-show="open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </span>
                    </button>
                    <div x-show="open" x-collapse class="px-8 pb-6 text-gray-600 text-base leading-relaxed">
                        Our tests are designed to be highly accurate and reliable. Each assessment is developed using standardized methods, validated datasets, and continuous performance reviews to ensure consistency.
                    </div>
                </div>

                <div x-data="{ open: false }" class="bg-gray-100 rounded-2xl transition-all duration-300">
                    <button @click="open = !open" class="w-full px-8 py-5 flex items-center justify-between text-left focus:outline-none cursor-pointer">
                        <span class="text-lg font-medium text-gray-900">Are results confidential?</span>
                        <span class="ml-4 shrink-0">
                            <svg x-show="!open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <svg x-show="open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </span>
                    </button>
                    <div x-show="open" x-collapse class="px-8 pb-6 text-gray-600 text-base leading-relaxed">
                        Yes, absolutely. We prioritize your privacy and data security above all else. Results are only shared with the specific recipients you authorize.
                    </div>
                </div>

                <div x-data="{ open: false }" class="bg-gray-100 rounded-2xl transition-all duration-300">
                    <button @click="open = !open" class="w-full px-8 py-5 flex items-center justify-between text-left focus:outline-none cursor-pointer">
                        <span class="text-lg font-medium text-gray-900">How long does each test take?</span>
                        <span class="ml-4 shrink-0">
                            <svg x-show="!open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <svg x-show="open" class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </span>
                    </button>
                    <div x-show="open" x-collapse class="px-8 pb-6 text-gray-600 text-base leading-relaxed">
                        Most tests take between 15 to 30 minutes to complete, depending on the complexity of the subject matter.
                    </div>
                </div>

            </div>
        </div>
    </section>

@endsection