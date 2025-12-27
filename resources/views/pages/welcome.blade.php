@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="min-h-[80vh] flex-col items-center justify-center bg-input-bg py-2 px-4 sm:px-6 lg:px-8">
    {{-- SECTION 7: PRICING / PLANS (Linked from Hero) --}}
    <section id="plans" class="py-2 bg-gray-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- OPTIONAL: Quick Dev Link (You can remove this later) --}}
            <div class="flex justify-center mb-6">
                <a href="{{ route('test-panel', ['slug' => 'professional-psychometric-69342f0c4f9a2']) }}" 
                   target="_blank"
                   class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
                    🚀 Launch Demo Test (Direct Link)
                </a>
            </div>

            <div class="text-center max-w-5xl mx-auto mb-4">
                <h2 class="text-3xl md:text-5xl font-serif text-gray-900 mb-4">
                   Hi, {{ session('user_name', 'Creator') }}!
                </h2>
                <div>
                    <a href="{{ route('udyantra-package') }}" 
                        class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
                        Package
                    </a>
                </div>
                <!-- <p class="text-gray-600 text-lg">
                    Comprehensive assessments tailored for your career stage.
                </p> -->
            </div>

            {{-- Alpine Component for Pricing Toggle --}}
            <!-- <div x-data="{ userType: 'student' }" class="flex flex-col items-center">
                
                {{-- Toggle Switch --}}
                <div class="flex  bg-white rounded-full border border-gray-200 p-1 mb-12 shadow-sm">
                    <button 
                        @click="userType = 'student'" 
                        :class="userType === 'student' ? 'bg-gray-900 text-white shadow-md' : 'text-gray-500 hover:text-gray-900'"
                        class="px-8 py-3 rounded-full text-sm font-bold transition-all duration-200 focus:outline-none"
                    >
                        For Students
                    </button>
                    <button 
                        @click="userType = 'professional'" 
                        :class="userType === 'professional' ? 'bg-gray-900 text-white shadow-md' : 'text-gray-500 hover:text-gray-900'"
                        class="px-8 py-3 rounded-full text-sm font-bold transition-all duration-200 focus:outline-none"
                    >
                        For Professionals
                    </button>
                </div>

                {{-- PRICING CARDS CONTAINER --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 w-full">
                    
                    {{-- CARD 1 (Dynamic based on toggle) --}}
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-xl flex flex-col relative overflow-hidden transition-all hover:-translate-y-1 hover:shadow-2xl">
                        <div class="absolute top-0 left-0 w-full h-2 bg-[#00AAD9]"></div>
                        
                        {{-- Student Content --}}
                        <div x-show="userType === 'student'" x-transition.opacity>
                            <h3 class="text-lg font-bold text-gray-500 uppercase tracking-wide mb-2">Basic</h3>
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-6">₹999</div>
                            <p class="text-gray-600 mb-8 text-sm h-10">Stream selection helper for Class 10th students.</p>
                            <ul class="space-y-4 mb-8 text-gray-600 text-sm">
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Interest Assessment</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Basic Report</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-gray-300 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg> <span class="text-gray-400">Counselor Call</span></li>
                            </ul>
                        </div>

                        {{-- Professional Content --}}
                        <div x-show="userType === 'professional'" style="display: none;" x-transition.opacity>
                            <h3 class="text-lg font-bold text-gray-500 uppercase tracking-wide mb-2">Starter</h3>
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-6">₹1,499</div>
                            <p class="text-gray-600 mb-8 text-sm h-10">Identify core strengths and working style.</p>
                            <ul class="space-y-4 mb-8 text-gray-600 text-sm">
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Personality Test</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 5-Page Report</li>
                            </ul>
                        </div>

                        <a href="#" class="mt-auto block w-full py-3 px-6 text-center rounded-lg border-2 border-gray-900 text-gray-900 font-bold hover:bg-gray-900 hover:text-white transition-colors">
                            Get Started
                        </a>
                    </div>

                    {{-- CARD 2 (Highlighted/Popular) --}}
                    <div class="bg-gray-900 rounded-2xl p-8 shadow-2xl flex flex-col relative overflow-hidden transform md:-translate-y-4">
                        <div class="absolute top-0 right-0 bg-[#00AAD9] text-white text-xs font-bold px-3 py-1 rounded-bl-lg">POPULAR</div>
                        
                        {{-- Student Content --}}
                        <div x-show="userType === 'student'" x-transition.opacity>
                            <h3 class="text-lg font-bold text-[#00AAD9] uppercase tracking-wide mb-2">Comprehensive</h3>
                            <div class="text-4xl font-serif font-bold text-white mb-6">₹2,499</div>
                            <p class="text-gray-400 mb-8 text-sm h-10">Full career roadmap for Class 11-12th & College.</p>
                            <ul class="space-y-4 mb-8 text-gray-300 text-sm">
                                <li class="flex items-center"><svg class="w-5 h-5 text-[#00AAD9] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Interest + Personality + Aptitude</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-[#00AAD9] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 20+ Page Detailed Report</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-[#00AAD9] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 1-on-1 Counselor Call</li>
                            </ul>
                        </div>

                        {{-- Professional Content --}}
                        <div x-show="userType === 'professional'" style="display: none;" x-transition.opacity>
                            <h3 class="text-lg font-bold text-[#00AAD9] uppercase tracking-wide mb-2">Career Growth</h3>
                            <div class="text-4xl font-serif font-bold text-white mb-6">₹3,999</div>
                            <p class="text-gray-400 mb-8 text-sm h-10">For career switchers and leadership roles.</p>
                            <ul class="space-y-4 mb-8 text-gray-300 text-sm">
                                <li class="flex items-center"><svg class="w-5 h-5 text-[#00AAD9] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Leadership Style Assessment</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-[#00AAD9] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Emotional Intelligence (EQ)</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-[#00AAD9] mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Expert Consultation</li>
                            </ul>
                        </div>

                        <a href="#" class="mt-auto block w-full py-3 px-6 text-center rounded-lg bg-[#00AAD9] text-white font-bold hover:bg-[#009ac4] transition-colors shadow-lg shadow-cyan-500/30">
                            Choose Plan
                        </a>
                    </div>

                    {{-- CARD 3 --}}
                    <div class="bg-white rounded-2xl p-8 border border-gray-100 shadow-xl flex flex-col relative overflow-hidden transition-all hover:-translate-y-1 hover:shadow-2xl">
                         <div class="absolute top-0 left-0 w-full h-2 bg-gray-200"></div>
                        
                        {{-- Student Content --}}
                        <div x-show="userType === 'student'" x-transition.opacity>
                            <h3 class="text-lg font-bold text-gray-500 uppercase tracking-wide mb-2">Premium</h3>
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-6">₹4,999</div>
                            <p class="text-gray-600 mb-8 text-sm h-10">Complete mentorship for college admissions.</p>
                            <ul class="space-y-4 mb-8 text-gray-600 text-sm">
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Everything in Comprehensive</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> 3 Sessions with Expert</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> College Application Support</li>
                            </ul>
                        </div>

                         {{-- Professional Content --}}
                         <div x-show="userType === 'professional'" style="display: none;" x-transition.opacity>
                            <h3 class="text-lg font-bold text-gray-500 uppercase tracking-wide mb-2">Corporate</h3>
                            <div class="text-4xl font-serif font-bold text-gray-900 mb-6">Custom</div>
                            <p class="text-gray-600 mb-8 text-sm h-10">For teams and organizations.</p>
                            <ul class="space-y-4 mb-8 text-gray-600 text-sm">
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Bulk Assessment Tokens</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Team Analytics Dashboard</li>
                                <li class="flex items-center"><svg class="w-5 h-5 text-green-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Dedicated Account Manager</li>
                            </ul>
                        </div>

                        <a href="#" class="mt-auto block w-full py-3 px-6 text-center rounded-lg border-2 border-gray-900 text-gray-900 font-bold hover:bg-gray-900 hover:text-white transition-colors">
                            Contact Sales
                        </a>
                    </div>

                </div>
            </div> -->
        </div>
    </section>

</div>
@endsection