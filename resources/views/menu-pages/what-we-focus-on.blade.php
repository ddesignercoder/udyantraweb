@extends('layouts.app') 
@section('title', 'What We Focus On')
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
{{-- SECTION 1: HERO Section --}}
<section class="relative bg-secondary w-full">
  <div class="max-w-7xl mx-auto px-4 md:px-6 pt-16 pb-0  relative z-10">
    <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-start">
      {{-- 2. Left Side: Text Content --}}
      <div class="text-center md:text-left space-y-6 w-full md:max-w-xl pt-0 md:pt-12">
        <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
          Mapping strengths to future possibilities
        </h1>
        <p class="text-textBlack text-lg md:text-xl leading-tight">
          Udyantra’s Career Assessment is based on a <strong>multi-dimensional, research-informed framework</strong> that evaluates students across several key areas rather than assigning a single personality type.
        </p>
      </div>
      {{-- 3. Right Side: OverlapDevice Mockup Image --}}
      <div class="text-center">
         <img src="{{ asset('assets/image/what-we-focus-on.svg') }}" 
          alt="What we Focus on" fetchpriority="high"
          class="mx-auto pointer-events-none w-[350px] mt-3 md:mt-0">
      </div>
    </div>
  </div>
</section>
<section class="relative bg-gray-100 w-full py-16 lg:py-22">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10 ">
      Our approach integrates:
    </h2>
    <div class="flex">
        <ul class="space-y-4  inline-block lg:max-w-[992px] mx-auto">
            <!-- Item 1 -->
            <li class="infobox">
                <div class="icon-box bg-secondary">
                <x-lucide-star class="w-6 h-6 text-white" />
                </div>
                <div class="content">
                <strong>Interest-based mapping</strong>
                <p class="text-sm text-gray-600">
                    (inspired by RIASEC / Holland Codes)
                </p>
                </div>
            </li>
            <!-- Item 2 -->
            <li class="infobox">
                <div class="icon-box bg-secondary">
                <x-lucide-user class="w-6 h-6 text-white" />
                </div>
                <div class="content">
                <strong>Personality tendencies</strong>
                <p class="text-sm text-gray-600">
                    (how a student prefers to think, behave, and interact)
                </p>
                </div>
            </li>
            <!-- Item 3 -->
            <li class="infobox">
                <div class="icon-box bg-secondary">
                <x-lucide-compass class="w-6 h-6 text-white" />
                </div>
                <div class="content">
                <strong>Orientation & work-style preferences</strong>
                <p class="text-sm text-gray-600">
                    (team vs individual, structure vs flexibility, creativity vs analysis)
                </p>
                </div>
            </li>
            <!-- Item 4 -->
            <li class="infobox">
                <div class="icon-box bg-secondary">
                <x-lucide-award class="w-6 h-6 text-white" />
                </div>
                <div class="content">
                <strong>Cognitive and aptitude indicators</strong>
                <p class="text-sm text-gray-600">
                    relevant to academic streams and career pathways
                </p>
                </div>
            </li>
        </ul>
    </div>
      {{-- Text Content --}}   
    <p class="lg:max-w-[992px] mx-auto text-textBlack text-center text-base md:text-lg leading-relaxed mt-8 md:mt-10">
      This allows us to identify <strong>multiple dominant traits</strong> in a student, offering a more realistic and flexible understanding of their strengths, rather than forcing them into one category.
    </p>
  </div>
</section>
{{-- SECTION 2: RISEC Framework Components --}}
<section class="relative w-full py-16 lg:py-22">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans">
      The five dimensions
    </h2>    
      {{-- Text Content --}}   
    <p class="lg:max-w-[992px] mx-auto text-textBlack text-center text-base md:text-lg leading-relaxed  mb-8 md:mb-10 ">
      This integrated approach ensures that recommendations are holistic, balanced, and practical.
    </p>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 max-w-7xl mx-auto text-center">
      {{-- R - Personality Traits --}}
      <div class="group relative p-6 flex flex-col bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-primary">
        <div class="flex items-center justify-start gap-4 mb-4">
          <div class="flex items-center justify-center w-12 h-12 bg-linear-to-br from-primary to-secondary rounded-full shrink-0">
            <x-lucide-user class="w-6 h-6 text-white" />
          </div>
          <h3 class="text-xl font-bold text-textBlack m-0 text-left">Personality Traits</h3>
        </div>
        <p class="text-textBlack text-base leading-relaxed text-left ">
          Measures stable personality characteristics that influence behaviour, communication style, decision-making, and work preferences.
        </p>
      </div>
      {{-- I - Interests & Motivations --}}
      <div class="group relative p-6 flex flex-col bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-secondary">
        <div class="flex items-center justify-start gap-4 mb-4">
          <div class="flex items-center justify-center w-12 h-12 bg-linear-to-br from-secondary to-primary rounded-full shrink-0">
            <x-lucide-star class="w-6 h-6 text-white" />
          </div>
          <h3 class="text-xl font-bold text-textBlack m-0 text-left">Interests & Motivations</h3>
        </div>
        <p class="text-textBlack text-base leading-relaxed text-left ">
          Identifies areas that naturally engage curiosity and long-term motivation, helping avoid burnout and misaligned choices.
        </p>
      </div>
      {{-- S - Skills & Strengths --}}
      <div class="group relative p-6 flex flex-col bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-primary">
        <div class="flex items-center justify-start gap-4 mb-4">
          <div class="flex items-center justify-center w-12 h-12 bg-linear-to-br from-primary to-secondary rounded-full shrink-0">
            <x-lucide-award class="w-6 h-6 text-white" />
          </div>
          <h3 class="text-xl font-bold text-textBlack m-0 text-left">Skills & Strengths</h3>
        </div>
        <p class="text-textBlack text-base leading-relaxed text-left ">
          Assesses cognitive abilities, learned skills, and natural aptitudes relevant to academic and career success.
        </p>
      </div>
      {{-- E - Orientation & Environment Fit --}}
      <div class="group relative p-6 flex flex-col bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-secondary">
        <div class="flex items-center justify-start gap-4 mb-4">
          <div class="flex items-center justify-center w-12 h-12 bg-linear-to-br from-secondary to-primary rounded-full shrink-0">
            <x-lucide-compass class="w-6 h-6 text-white" />
          </div>
          <h3 class="text-xl font-bold text-textBlack m-0 text-left">Orientation & Environment Fit</h3>
        </div>
        <p class="text-gray-700 text-base leading-relaxed text-left ">
          Evaluates how an individual aligns with different learning styles, work environments, and role expectations.
        </p>
      </div>
      {{-- C - Career Mapping --}}
      <div class="group relative p-6 flex flex-col bg-white rounded-xl shadow-lg transition-all duration-300 hover:shadow-2xl hover:-translate-y-2 border-t-4 border-primary md:col-span-2 lg:col-span-1">
        <div class="flex items-center justify-start gap-4 mb-4">
          <div class="flex items-center justify-center w-12 h-12 bg-linear-to-br from-primary to-secondary rounded-full shrink-0">
            <x-lucide-briefcase class="w-6 h-6 text-white" />
          </div>
          <h3 class="text-xl font-bold text-textBlack m-0 text-left">Career Mapping</h3>
        </div>
        <p class="text-textBlack text-base leading-relaxed text-left ">
          Integrates all dimensions to suggest realistic, aligned, and future-ready career pathways and development directions.
        </p>
      </div>
    </div>
  </div>
</section>
{{-- SECTION 3: Development Process --}}
<section class="relative bg-gray-100 w-full py-16 lg:py-22">
  <div class="max-w-7xl mx-auto px-4 md:px-6">
    <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans  ">
      Structured & scientific development process
    </h2>
    {{-- Text Content --}}   
    <p class="lg:max-w-[992px] mx-auto text-textBlack text-center text-base md:text-lg leading-relaxed mb-8 md:mb-10">
      Every assessment is built with precision, validated through research, and designed to deliver actionable insights.
    </p>
    <div class="bg-white rounded-xl shadow-xl p-6 relative">
      <div class="space-y-4">
        {{-- Step 1 --}}
        <div class="flex flex-col">
          <div class="block md:flex items-center gap-6 pt-2 pb-4">
            <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl mb-4 md:mb-0">
              <x-lucide-book-open class="w-7 h-7" />
            </div>
            <div>
            <h3 class="text-xl font-bold text-textBlack m-0">Construct Definition</h3>
            <p class="text-textBlack text-base text-left leading-relaxed ">
            Each section is based on clearly defined psychological constructs such as aptitude, personality traits, interests, and orientation.
          </p>
            </div>
          </div>
          
        </div>
        {{-- Divider --}}
        <div class="border-t border-gray-200  pb-4"></div>
        {{-- Step 2 --}}
        <div class="flex flex-col gap-2">
          <div class="block md:flex items-center gap-6 pb-4">
            <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl mb-4 md:mb-0">
              <x-lucide-pen-tool class="w-7 h-7" />
            </div>
            <div>
              <h3 class="text-xl font-bold text-textBlack m-0">Question Design</h3>
              <p class="text-textBlack text-base text-left leading-relaxed">
              Questions use validated formats such as Likert scales, situational judgment items, and aptitude-based patterns.
              </p>
            </div>
          </div>          
        </div>
        {{-- Divider --}}
        <div class="border-t border-gray-200 pb-4"></div>
        {{-- Step 3 --}}
        <div class="flex flex-col gap-2">
          <div class="block md:flex items-center gap-6 pb-4">
            <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl mb-4 md:mb-0">
              <x-lucide-scale class="w-7 h-7" />
            </div>
            <div>
              <h3 class="text-xl font-bold text-textBlack m-0">Bias Reduction</h3>
              <p class="text-textBlack text-base text-left leading-relaxed">
                Items are reviewed to minimize cultural, academic, and gender bias.
              </p>
            </div>
          </div>
        </div>
        {{-- Divider --}}
        <div class="border-t border-gray-200 pb-4"></div>
        {{-- Step 4 --}}
        <div class="flex flex-col gap-2">
          <div class="block md:flex items-center gap-6 pb-4">
            <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl mb-4 md:mb-0">
              <x-lucide-bar-chart-2 class="w-7 h-7" />
            </div>
            <div>
              <h3 class="text-xl font-bold text-textBlack m-0">Scoring & Scaling</h3>
              <p class="text-textBlack text-base text-left leading-relaxed">
                Responses are converted into standardized scores for objective comparison and interpretation.
              </p>
            </div>
          </div>
          
        </div>
        {{-- Divider --}}
        <div class="border-t border-gray-200 pb-4"></div>
        {{-- Step 5 --}}
        <div class="flex flex-col gap-2">
          <div class="block md:flex items-center gap-6 pb-2">
            <div class="shrink-0 flex items-center justify-center w-14 h-14 bg-linear-to-br from-primary to-secondary rounded-full text-white font-bold text-xl mb-4 md:mb-0">
              <x-lucide-clipboard-check class="w-7 h-7" />
            </div>
            <div>
              <h3 class="text-xl font-bold text-textBlack m-0">Expert Interpretation Framework</h3>
              <p class="text-textBlack text-base text-left leading-relaxed">
                Results are translated into actionable insights using structured interpretation models — not random AI outputs.
              </p>
            </div>
          </div>          
        </div>
      </div>
    </div>
  </div>
</section>
{{-- SECTION 4: Success Stories --}}
<section class="py-6 md:py-14 bg-white  relative z-10">
  <div class="max-w-7xl mx-auto px-4 md:px-4">
    <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black  mb-8 md:mb-10">
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
<section class=" relative z-0 pt-65 md:pt-70 lg:pt-68 pb-16 lg:py-22">
  <x-faq />
</section>
{{-- SECTION 6: Sign Up Today --}}
<!-- <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100  relative">
  <x-register />
  </section> -->
@endsection