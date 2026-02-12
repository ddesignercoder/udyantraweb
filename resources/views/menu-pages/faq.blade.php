@extends('layouts.app') 
@section('title', 'FAQ')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
{{-- SECTION 1: HERO Section --}}
<section class="relative bg-secondary w-full">
   <div class="max-w-7xl mx-auto px-4 md:px-6 pt-16 pb-0  relative z-10">
      <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-start ">
         {{-- 2. Left Side: Text Content --}}
         <div class="text-center md:text-left space-y-6 w-full md:max-w-xl">
            <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
               Frequently Asked Questions
            </h1>
            <p class="text-textBlack text-lg md:text-xl leading-tight">
             Udyantra’s assessments are built on established psychology and global assessment practices. <br/><br/>Rooted in psychometrics, they objectively measure individual traits and abilities to provide accurate, reliable, and research-backed insights for meaningful decision-making.
            </p>
         </div>
         {{-- 3. Right Side: OverlapDevice Mockup Image --}}
         <div class="text-end">
            <img src="{{ asset('assets/image/faq.svg') }}" 
               alt="Sceintic Foundation"  fetchpriority="high"
               class="mx-auto pointer-events-none w-[500px] mt-3 md:mt-0">
         </div>
      </div>
   </div>
</section>
<section class="font-sans relative w-full py-16 lg:py-22">
   <x-faq />
</section>

@endsection