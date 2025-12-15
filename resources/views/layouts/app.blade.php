<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Udyantra') - Udyantra</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/favicon.png') }}">    
    {{-- Alpine.js --}}
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans text-navy bg-cyan-light/20 min-h-screen flex flex-col">

    {{-- HEADER (Navigation + Mobile Menu) --}}
    <header class="bg-white text-gray-800 shadow-md sticky top-0 z-50 font-sans" x-data="{ mobileMenuOpen: false }">
        
        <nav class="w-full max-w-7xl mx-auto px-2 md:px-4">
            <div class="flex justify-between h-16 items-center">
                
                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center gap-2 transition hover:opacity-90 shrink-0">
                    <img src="{{ asset('assets/image/Udyantra-Logo.png') }}" 
                         alt="Udyantra" 
                         class="h-10 md:h-12 w-auto object-contain">
                </a>

                {{-- Desktop Menu Links --}}
                <div class="hidden md:flex items-center gap-6 lg:gap-8 font-semibold text-sm lg:text-base text-black">
                    <a href="#why-choose-us" class="hover:text-[#00AAD9] transition-colors">Why Choose Us</a>
                    <a href="#focus" class="hover:text-[#00AAD9] transition-colors">What We Focus On</a>
                    <a href="#pricing" class="hover:text-[#00AAD9] transition-colors">Pricing</a>
                    <a href="#faq" class="hover:text-[#00AAD9] transition-colors">FAQs</a>
                    <a href="#contact" class="hover:text-[#00AAD9] transition-colors">Contact Us</a>
                </div>

                {{-- Desktop Action Buttons --}}
                <div class="hidden md:flex items-center gap-6">
                    <div class="bg-[#00AAD9] text-white rounded-full px-6 py-2.5 flex items-center font-medium shadow-sm hover:bg-[#00a0c9] transition duration-200">
                        @if(session('api_token'))
                            <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                                @csrf
                                <button type="submit" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">Login</a>
                            <span class="mx-2 opacity-100">|</span>
                            <a href="{{ route('register') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">Register</a>
                        @endif
                    </div>
                </div>

                {{-- Mobile Menu Trigger --}}
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-gray-600 focus:outline-none p-2">
                        {{-- Hamburger Icon --}}
                        <x-lucide-menu x-show="!mobileMenuOpen" class="h-6 w-6" />
                        
                        {{-- Close Icon --}}
                        <x-lucide-x x-show="mobileMenuOpen" style="display: none;" class="h-6 w-6" />
                    </button>
                </div>
            </div>
        </nav>

        {{-- Mobile Menu Dropdown --}}
        <div x-show="mobileMenuOpen" 
             style="display: none;"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-white border-t border-gray-100 shadow-lg absolute w-full left-0">
            
            <div class="px-4 py-4 space-y-2 flex flex-col font-medium text-gray-700">
                {{-- Login/Register at Top --}}
                <div class="pb-2 border-b border-gray-100 mb-2">
                    @if(session('api_token'))
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-red-50 text-red-600 py-2.5 rounded-lg font-bold">
                                <x-lucide-log-out class="w-4 h-4" />
                                Logout
                            </button>
                        </form>
                    @else
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 bg-[#00AAD9] text-white py-2.5 rounded-lg font-semibold">
                                <x-lucide-log-in class="w-4 h-4" />
                                Login
                            </a>
                            <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 bg-[#00AAD9] text-white py-2.5 rounded-lg font-semibold">
                                <x-lucide-user-plus class="w-4 h-4" />
                                Register
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Mobile Links --}}
                <a href="#why-choose-us" class="block px-3 py-2 rounded-md hover:bg-cyan-50 hover:text-[#00AAD9] transition">Why Choose Us</a>
                <a href="#focus" class="block px-3 py-2 rounded-md hover:bg-cyan-50 hover:text-[#00AAD9] transition">What We Focus On</a>
                <a href="#pricing" class="block px-3 py-2 rounded-md hover:bg-cyan-50 hover:text-[#00AAD9] transition">Pricing</a>
                <a href="#faq" class="block px-3 py-2 rounded-md hover:bg-cyan-50 hover:text-[#00AAD9] transition">FAQs</a>
                <a href="#contact" class="block px-3 py-2 rounded-md hover:bg-cyan-50 hover:text-[#00AAD9] transition">Contact Us</a>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>

    {{-- FOOTER --}}
    <footer class="relative bg-[#00AAD9] text-white pt-8 pb-8 px-4 md:px-6 overflow-hidden font-sans">
        
        {{-- 1. Background Leaf Decoration (Right Side) --}}
        <div class="absolute bottom-[-8%] left-[65%] pointer-events-none opacity-80 w-[300px] md:w-[480px] z-0">
            <img src="{{ asset('assets/image/home/logo-symbol.svg') }}" 
                 alt="Background Leaf" 
                 class="w-full h-auto object-contain ">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">

                {{-- COLUMN 1: Brand & Description --}}
                <div class="md:col-span-5 space-y-6">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="inline-block">
                        <img src="{{ asset('assets/image/Udyantra-Logo.png') }}" 
                             alt="Udyantra" 
                             class="h-12 w-auto object-contain brightness-0 invert">
                    </a>
                    
                    <p class="text-white/90 text-sm leading-relaxed pr-0 md:pr-12 text-justify">
                        Udyantra is the platform for experts and businesses who take education seriously. 
                        In a world where anyone can ask AI for information, we're the home for those who 
                        educate with purpose, modernity, and humanity. We power human-led learning that 
                        drives student trust, connection, and results.
                    </p>
                </div>

                {{-- COLUMN 2: Quick Links --}}
                <div class="md:col-span-2">
                    <h3 class="text-lg font-bold mb-6">Quick links</h3>
                    <ul class="space-y-3 text-sm font-medium text-white/90">
                        <li><a href="{{ route('home') }}" class="hover:text-white hover:underline transition">Home</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">About us</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Contact</a></li>
                    </ul>
                </div>

                {{-- COLUMN 3: Policies --}}
                <div class="md:col-span-2">
                    <h3 class="text-lg font-bold mb-6">Policies</h3>
                    <ul class="space-y-3 text-sm font-medium text-white/90">
                        <li><a href="#" class="hover:text-white hover:underline transition">Terms of use</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Privacy policy</a></li>
                    </ul>
                </div>

                {{-- COLUMN 4: Follow Us --}}
                <div class="md:col-span-3">
                    <h3 class="text-lg font-bold mb-6">Follow Us</h3>
                    <div class="flex gap-4">
                        {{-- Facebook --}}
                        <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                            <x-lucide-facebook class="w-5 h-5" />
                        </a>
                        
                        {{-- Instagram --}}
                        <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                            <x-lucide-instagram class="w-5 h-5" />
                        </a>

                        {{-- X (Twitter) --}}
                        <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                            <x-lucide-twitter class="w-5 h-5" />
                        </a>

                        {{-- YouTube --}}
                        <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                            <x-lucide-youtube class="w-5 h-5" />
                        </a>

                        {{-- LinkedIn --}}
                        <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                            <x-lucide-linkedin class="w-5 h-5" />
                        </a>
                    </div>
                </div>

            </div>
            
        </div>
    </footer>

    @include('partials.toast-script')
</body>
</html>