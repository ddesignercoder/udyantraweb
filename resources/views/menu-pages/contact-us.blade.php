@extends('layouts.app') 
@section('title', 'Contact Udyantra | Career Guidance & Support Team India')
@section('description', 'Get in touch with Udyantra for career guidance, psychometric tests, and support. Our team is here to help you choose the right career path.')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection
@section('content')
{{-- SECTION 1: HERO Section --}}
<section class="relative bg-secondary w-full">
   <div class="max-w-7xl mx-auto px-4 md:px-6 pt-8 md:pt-16 pb-0  relative z-10">
      <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-start ">
         {{-- 2. Left Side: Text Content --}}
         <div class="text-center md:text-left space-y-6 w-full md:max-w-xl">
            <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
               Contact Us
            </h1>
               <ul>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/e-mail.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Email:  <a href="mailto: care@udyantra.com">care@udyantra.com</a></li><br/>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/e-mail.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Email: <a href="founder@udyantra.com">founder@udyantra.com</a></li><br/>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/call.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Tel: <a href="+918076627508">+91 807 662 7508</a></li><br/>
                  <li class="flex items-center"><img src="{{ asset('assets/image/contact-us/call.svg') }}" 
               alt="Email Icon"  loading="lazy" class="flex pointer-events-none w-6"/>&nbsp;&nbsp;Tel: <a href="+918273494712">+91 827 349 4712</a></li><br/>
               </ul>
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
<section class="relative w-full bg-gray-50">
   <div class="max-w-4xl mx-auto px-4 md:px-6 py-8 md:py-16 relative z-10">
      <div class="bg-white space-y-6 p-8 md:p-12 rounded-2xl shadow-lg transition-all duration-300 hover:shadow-xl hover:-translate-y-2 hover:ring-2 hover:ring-primary/50 overflow-hidden border-0 animate-fade-in-up animation-delay-1000">
         <h2 class="text-sizeMobile lg:text-3xl font-semibold text-center text-black font-sans mb-8">
            Get in touch
         </h2>

         <form action="{{ route('enquiry.submit') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1">
               <input type="text" name="name" autocomplete="name"
                  placeholder="Enter Name" value="{{ old('name') }}"
                  class="block w-full px-3 py-2 text-base text-gray-900 border-b border-gray-300 focus:outline-none focus:border-b-2 focus:border-primary placeholder:text-gray-400 sm:text-sm/6 transition-colors">
               @error('name') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-6">
               <div>
                  <input type="email" name="email" autocomplete="email"
                     placeholder="Enter Email" value="{{ old('email') }}"
                     class="block w-full px-3 py-2 text-base text-gray-900 border-b border-gray-300 focus:outline-none focus:border-b-2 focus:border-primary placeholder:text-gray-400 sm:text-sm/6 transition-colors">
                  @error('email') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
               </div>

               <div>
                  <input type="tel" name="phone"
                     placeholder="Enter Contact Number" value="{{ old('phone') }}"
                     pattern="^(\+?\d{1,4}[\s-])?(?!0+\s+,?$)\d{10}\s*,?$"
                     title="Please enter a valid 10-digit phone number. Optionally include a country code starting with +"
                     minlength="10" maxlength="10" required
                     class="block w-full px-3 py-2 text-base text-gray-900 border-b border-gray-300 focus:outline-none focus:border-b-2 focus:border-primary placeholder:text-gray-400 sm:text-sm/6 transition-colors">
                  @error('phone') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
               </div>
            </div>

            <div class="grid grid-cols-1 mt-6">
               <textarea rows="4" name="message"
                  placeholder="Your Message"
                  class="block w-full px-3 py-2 text-base text-gray-900 border-b border-gray-300 focus:outline-none focus:border-b-2 focus:border-primary placeholder:text-gray-400 sm:text-sm/6 transition-colors">{{ old('message') }}</textarea>
               @error('message') <span class="text-red-500 text-sm mt-1 block">{{ $message }}</span> @enderror
            </div>
            
            <div class="mt-10 text-center">
               <x-button type="submit" variant="secondary" class="w-full md:w-auto px-10 py-3 text-lg rounded-full">Submit Message</x-button>
            </div>
         </form>

      </div>
   </div>
</section>


@endsection