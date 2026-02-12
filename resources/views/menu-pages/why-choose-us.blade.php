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
<section class="relative bg-secondary w-full">
   <div class="max-w-7xl mx-auto px-4 md:px-6 pt-16 pb-0  relative z-10">
      <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-start ">
         {{-- 2. Left Side: Text Content --}}
         <div class="text-center md:text-left space-y-6 w-full md:max-w-xl">
            <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
               Our Scientific  Foundation
            </h1>
            <p class="text-textBlack text-lg md:text-xl leading-tight">
               Built on established psychology and global assessment practices<br/><br/>
               Udyantra's assessments are grounded in the field of psychometrics, a branch of psychology focused on the objective measurement of human traits and abilities.
            </p>
            <div class="pt-0">
                <x-button variant="secondary" as="a" class="mt-6" href="{{ route('udyantra-package') }}">Explore our plan</x-button>
            </div>
         </div>
         {{-- 3. Right Side: OverlapDevice Mockup Image --}}
         <div class="text-end">
            <img src="{{ asset('assets/image/whychooseus/why-choose-us-banner.svg') }}" 
               alt="Sceintic Foundation"  fetchpriority="high"
               class="mx-auto pointer-events-none w-[500px] mt-3 md:mt-0">
         </div>
      </div>
   </div>
</section>
{{-- SECTION 2: Our assessment design draws from --}}
<section class="relative bg-gray-100 w-full py-16 lg:py-22">
   <div class="max-w-7xl mx-auto px-4 md:px-6">
      <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10 ">
         Our assessment design draws from
      </h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 items-center">
         <div class=" gap-4 animate-fade-in-left animation-delay-500 group/item bg-white p-6 rounded-lg">
            <div class="shrink-0 items-center transition-all duration-300 group-hover/item:scale-110">
               <img src="{{ asset('assets/image/whychooseus/personality-theory.svg') }}" 
                  alt="Trait-based personality theories" class="mx-auto pointer-events-none w-18 h-18">
            </div>
            <p class="text-textBlack text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary text-center">Trait-based personality theories</p>
         </div>
         <div class=" gap-4 animate-fade-in-left animation-delay-500 group/item bg-white p-6 rounded-lg">
            <div class="shrink-0 items-center transition-all duration-300 group-hover/item:scale-110">
               <img src="{{ asset('assets/image/whychooseus/aptitude-ability.svg') }}" 
                  alt="Aptitude and ability measurement models" class="mx-auto pointer-events-none w-18 h-18">
            </div>
            <p class="text-textBlack text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary text-center">Aptitude and ability measurement models</p>
         </div>
         <div class=" gap-4 animate-fade-in-left animation-delay-500 group/item bg-white p-6 rounded-lg">
            <div class="shrink-0 items-center transition-all duration-300 group-hover/item:scale-110">
               <img src="{{ asset('assets/image/whychooseus/interest-career.svg') }}" 
                  alt="Interest–career alignment framework" class="mx-auto pointer-events-none w-18 h-18">
            </div>
            <p class="text-textBlack text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary text-center">Interest–career alignment framework</p>
         </div>
         <div class=" gap-4 animate-fade-in-left animation-delay-500 group/item bg-white p-6 rounded-lg">
            <div class="shrink-0 items-center transition-all duration-300 group-hover/item:scale-110">
               <img src="{{ asset('assets/image/whychooseus/assessment-principles.svg') }}" 
                  alt="Educational and vocational assessment principles" class="mx-auto pointer-events-none w-18 h-18">
            </div>
            <p class="text-textBlack text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary text-center">Educational and vocational assessment principles</p>
         </div>
         <div class=" gap-4 animate-fade-in-left animation-delay-500 group/item bg-white p-6 rounded-lg">
            <div class="shrink-0 items-center transition-all duration-300 group-hover/item:scale-110">
               <img src="{{ asset('assets/image/whychooseus/criterion-based-scoring.svg') }}" 
                  alt="Sceintic Foundation" class="mx-auto pointer-events-none w-18 h-18">
            </div>
            <p class="text-textBlack text-lg flex-1 transition-colors duration-300 group-hover/item:text-primary text-center">Norm-referenced and criterion-based scoring methods</p>
         </div>
         {{-- Text Content --}}             
      </div>
      <p class="lg:max-w-[992px] mx-auto text-textBlack text-center text-base leading-relaxed mt-8 md:mt-10">
         Each question is mapped to a defined psychological construct, ensuring that results are reliable, structured, and meaningful, rather than generic personality labels.
      </p>
   </div>
</section>
{{-- SECTION 3: RESEARCH & EVIDENCE BASE --}}
<section class="bg-white w-full  py-16 lg:py-22">
   <div class="max-w-7xl mx-auto px-4 md:px-6">
      <div class="flex flex-col items-center text-center ">
         {{-- Heading --}}
         <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans">
            Research & evidence base
         </h2>
         {{-- Lead Text--}}
         <div class="space-y-5 w-full text-base text-textBlack ">
            <p class=" mb-8 md:mb-10">
               Grounded in established psychological research
            </p>
            <p class="text-textBlack text-lg mb-6 mx-auto animate-fade-in-up animation-delay-800">
               The principles behind Udyantra's assessments align with widely accepted research and practices used in:
            </p>
         </div>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10 mb-8">
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-400">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/educational-psychology.svg') }}" 
                     alt="Educational psychology" 
                     class="w-full h-full object-cover">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Educational psychology</h5>
            </div>
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-500">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-400 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/guidance-counseling.svg') }}" 
                     alt="Career guidance and counseling" 
                     class="w-full h-full object-cover">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Career guidance and counseling</h5>
            </div>
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-600">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-500 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/assessment-development.svg') }}" 
                     alt="Talent assessment and development" 
                     class="w-full h-full object-cover">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Talent assessment and development</h5>
            </div>
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-700">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-600 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/vocational-aptitude-testing.svg') }}" 
                     alt="Vocational and aptitude testing" 
                     class="w-full h-full object-cover">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Vocational and aptitude testing</h5>
            </div>
         </div>
         <p class="text-textBlack text-lg mb-6 mx-auto animate-fade-in-up animation-delay-800">
            Similar psychometric principles are used globally by:
         </p>
         <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-900">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/educational-institutions.svg') }}" 
                     alt="Educational institutions" 
                     class="w-full h-full object-cover">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Educational institutions</h5>
            </div>
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-400 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/counselors-psychologists.svg') }}" 
                     alt="Career counselors and psychologists" 
                     class="w-full h-full object-cover">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Career counselors and psychologists</h5>
            </div>
            <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
               <div class="w-30 h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-500 group-hover:scale-110">
                  <img src="{{ asset('assets/image/whychooseus/hiring-development.svg') }}" 
                     alt="Corporate hiring and development programs" 
                     class="">
               </div>
               <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Corporate hiring and development programs</h5>
            </div>
         </div>
         <p class="lg:max-w-[992px] mx-auto text-textBlack text-center text-base leading-relaxed mt-8 md:mt-10">
            Udyantra adapts these principles for Indian students and professionals, ensuring relevance, clarity, and practical application.
         </p>
      </div>
   </div>
</section>
<!-- <section class="relative w-full pt-14 pb:16 lg:pt-18 lg:pb-22">
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
                   
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-400">
                   <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                       <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                           alt="Educational psychology" 
                           class="w-full h-full object-cover">
                   </div>
                   <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Educational psychology</h5>
               </div>
               
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-500">
                   <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                       <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                           alt="Career guidance and counseling" 
                           class="w-full h-full object-cover">
                   </div>
                   <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Career guidance and counseling</h5>
               </div>
               
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-600">
                   <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                       <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                           alt="Talent assessment and development" 
                           class="w-full h-full object-cover">
                   </div>
                   <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Talent assessment and development</h5>
               </div>
               
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-700">
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
                   
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-900">
                   <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                       <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                           alt="Educational institutions" 
                           class="w-full h-full object-cover">
                   </div>
                   <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Educational institutions</h5>
               </div>
               
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
                   <div class="w-12 h-12 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto transition-transform duration-300 group-hover:scale-110">
                       <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                           alt="Career counselors and psychologists" 
                           class="w-full h-full object-cover">
                   </div>
                   <h5 class="text-base py-3 md:py-3 font-semibold text-black transition-colors duration-300 group-hover:text-primary">Career counselors and psychologists</h5>
               </div>
               
               <div class="group relative p-6 grow flex flex-col bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
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
   
   </section> -->
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
{{--    
<section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100 font-sans relative">
   <x-register />
</section>
--}}
@endsection