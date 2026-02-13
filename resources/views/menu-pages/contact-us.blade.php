@extends('layouts.app') 
@section('title', 'Contact Us')
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
               Contact Us
            </h1>
            <p class="text-textBlack text-lg md:text-xl leading-tight">
             Lorem Ipsum is simply dummy text of the printing and typesetting industry.<br/><br/>
              Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
         </div>
         {{-- 3. Right Side: OverlapDevice Mockup Image --}}
         <div class="text-end">
            <img src="{{ asset('assets/image/contact-us/contact-us.svg') }}" 
               alt="Contact Us"  fetchpriority="high"
               class="mx-auto pointer-events-none w-[500px] mt-3 md:mt-0">
         </div>
      </div>
   </div>
</section>
<section class="relative  w-full">
   <div class="max-w-7xl mx-auto px-4 md:px-6 py-16 relative z-10">
      <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 justify-between items-start ">
         <div>
         {{-- 2. Left Side: Text Content --}}
            <div class="text-center md:text-left space-y-6 pe-6 lg:pe-54 p-6  lg:inline-block  rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
               <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center md:text-left text-black font-sans">
                  Contact us here
               </h2> 
               <ul>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/e-mail.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Email: support@udyantra.com</li><br/>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/call.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Tel: +91 XXX-XXX-XXXX</li><br/>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/location-map.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Add: Delhi</li>
               </ul>
            </div>
         </div>
         {{-- 3. Right Side: OverlapDevice Mockup Image --}}
         <div  class="text-center md:text-left space-y-6  p-6  inline-block  rounded-xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 text-center animate-fade-in-up animation-delay-1000">
            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center md:text-left text-black font-sans">
                 Get in touch
               </h2>
         <form>
   <div class="grid grid-cols-1">
      <input type="text" name="full-name" autocomplete="full-name"
         placeholder="Enter Name"
         class="block w-full px-3 py-1.5 text-base text-gray-900
         border-b border-gray-300
         focus:outline-none focus:border-b-2 focus:border-gray-600
         placeholder:text-gray-400 sm:text-sm/6">
   </div>

   <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-4">
      <input type="email" name="email" autocomplete="email"
         placeholder="Enter Email"
         class="block w-full px-3 py-1.5 text-base text-gray-900
         border-b border-gray-300
         focus:outline-none focus:border-b-2 focus:border-gray-600
         placeholder:text-gray-400 sm:text-sm/6">

      <input type="text"
         placeholder="Enter contact Number"
         class="block w-full px-3 py-1.5 text-base text-gray-900
         border-b border-gray-300
         focus:outline-none focus:border-b-2 focus:border-gray-600
         placeholder:text-gray-400 sm:text-sm/6">
   </div>

   <div class="grid grid-cols-1 mt-4">
      <textarea rows="3"
         placeholder="Your Message"
         class="block w-full px-3 py-1.5 text-base text-gray-900
         border-b border-gray-300
         focus:outline-none focus:border-b-2 focus:border-gray-600
         placeholder:text-gray-400 sm:text-sm/6"></textarea>
   </div>
   <div class="mt-4">
                <x-button type="submit" variant="secondary" as="a" class="mt-6" href="#">Save</x-button>
            </div>
</form>

         </div>
      </div>
   </div>
</section>


@endsection