{{-- HEADER (Navigation + Mobile Menu) --}}
    {{-- 1. Updated x-data and added @scroll.window --}}
    <header 
        class="bg-white shadow-md sticky top-0 z-50 font-sans transition-transform duration-300 ease-in-out" 
        x-data="{ 
            mobileMenuOpen: false,
            show: true,
            lastScroll: 0,
            updateScroll() {
                const currentScroll = window.pageYOffset;
                
                // Close mobile menu if open
                if (this.mobileMenuOpen) {
                    this.mobileMenuOpen = false;
                }

                // Always show if at the very top or if mobile menu is open
                if (currentScroll <= 0 ) {
                    this.show = true;
                } 
                // Hide if scrolling down
                else if (currentScroll > this.lastScroll) {
                    this.show = false;
                } 
                // Show if scrolling up
                else {
                    this.show = true;
                }
                
                this.lastScroll = currentScroll; 
            }
        }"
        @scroll.window="updateScroll()"
        @click.outside="mobileMenuOpen = false"
        :class="show ? 'translate-y-0' : '-translate-y-full'"
    >
        
        <nav class="w-full max-w-7xl mx-auto px-2 md:px-4">
            <div class="flex justify-between h-16 items-center">
                
                {{-- Logo --}} 
                <a href="{{ route('home') }}" class="flex items-center gap-2 transition hover:opacity-90 shrink-0">
                    <img src="{{ asset('assets/image/Udyantra-logo.svg') }}" 
                         alt="Udyantra" 
                         class="h-16 w-auto object-contain">
                </a>

                {{-- Desktop Menu Links --}}
                <div class="hidden lg:flex items-center gap-6 lg:gap-8 font-semibold text-sm lg:text-base text-black">
                    <a href="{{ route('why-choose-us') }}" class="{{ request()->routeIs('why-choose-us') ? 'text-primary' : '' }} hover:text-primary active:text-primary transition-colors">Why Choose Us</a>
                    <a href="{{ route('what-we-focus-on') }}" class="{{ request()->routeIs('what-we-focus-on') ? 'text-primary' : '' }} hover:text-primary active:text-primary transition-colors">What We Focus On</a>
                    <a href="{{ route('udyantra-package') }}" class="{{ request()->routeIs('udyantra-package') ? 'text-primary' : '' }} hover:text-primary active:text-primary transition-colors">Pricing</a>
                    <a href="{{ route('citations')}}" class="{{ request()->routeIs('citations') ? 'text-primary' : '' }} hover:text-primary active:text-primary transition-colors">Citations</a>
                    <a href="{{route('faq')}}" class="hover:text-primary transition-colors active:text-primary ">FAQs</a>
                    <a href="{{route('contact-us')}}" class="hover:text-primary transition-colors active:text-primary ">Contact Us</a>
                </div>

                {{-- Desktop Action Buttons --}}
                <div class="hidden lg:flex items-center gap-6">
                    <div class="bg-primary text-white rounded-full px-6 py-2.5 flex items-center font-medium shadow-sm hover:bg-primary-light transition duration-200">
                        @if(session('api_token'))
                            <a href="{{ route('user.dashboard') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">Dashboard</a>
                            <span class="mx-2 opacity-100">|</span>
                            <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                                @csrf
                                <button type="submit" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">Login</a>
                            <span class="mx-2 opacity-100">|</span>
                            {{-- ✅ UPDATED: Points to Selection Page --}}
                            <a href="{{ route('register.select') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">Register</a>
                        @endif
                    </div>
                </div>

                {{-- Mobile Menu Trigger --}}
                <div class="lg:hidden flex items-center ">
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-black focus:outline-none p-2 cursor-pointer">
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
           
            class="fixed inset-y-0 right-0 w-full sm:w-80 bg-white h-screen shadow-lg z-50"
            @click.outside="mobileMenuOpen = false">
            
            <div class="px-4 py-4 space-y-2 flex flex-col font-medium text-black bg-white" @click="mobileMenuOpen = false">
                <button @click="mobileMenuOpen = false" class="mb-4 text-start cursor-pointer">
                    ✕
                </button>
                {{-- Login/Register at Top --}}
                <div class="pb-2 border-b border-gray-100 mb-2">
                    @if(session('api_token'))
                        <a href="{{ route('user.dashboard') }}" class="w-full flex items-center justify-center gap-2 bg-primary text-white py-2.5 rounded-lg font-bold mb-4">
                            <x-lucide-user class="w-4 h-4" />
                            Dashboard
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-center gap-2 bg-primary text-white py-2.5 rounded-lg font-bold">
                                <x-lucide-log-out class="w-4 h-4" />
                                Logout
                            </button>
                        </form>
                    @else
                        <div class="grid grid-cols-2 gap-3">
                            <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 bg-primary text-white py-2.5 rounded-lg font-semibold">
                                <x-lucide-log-in class="w-4 h-4" />
                                Login
                            </a>
                            {{-- ✅ UPDATED: Points to Selection Page --}}
                            <a href="{{ route('register.select') }}" class="flex items-center justify-center gap-2 bg-primary text-white py-2.5 rounded-lg font-semibold">
                                <x-lucide-user-plus class="w-4 h-4" />
                                Register
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Mobile Links --}}
                <a href="{{ route('why-choose-us') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('why-choose-us') ? 'text-primary bg-primary/10' : '' }} hover:text-primary active:text-primary transition">Why Choose Us</a>
                <a href="{{ route('what-we-focus-on') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('what-we-focus-on') ? 'text-primary bg-primary/10' : '' }} hover:text-primary active:text-primary transition">What We Focus On</a>
                <a href="{{ route('udyantra-package') }}" class="block px-3 py-2 rounded-md {{ request()->routeIs('udyantra-package') ? 'text-primary bg-primary/10' : '' }} hover:text-primary active:text-primary transition">Pricing</a>
                <a href="{{route('citations')}}" class="block px-3 py-2 rounded-md {{ request()->routeIs('citations') ? 'text-primary bg-primary/10' : '' }} hover:text-primary active:text-primary transition">Citations</a>
                <a href="{{route('faq')}}" class="block px-3 py-2 rounded-md active:text-primary transition">FAQs</a>
                <a href="#contact" class="block px-3 py-2 rounded-md active:text-primary transition">Contact Us</a>
            </div>
        </div>
    </header>