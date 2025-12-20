    {{-- HEADER (Navigation + Mobile Menu) --}}
    <header class="bg-white  shadow-md sticky top-0 z-50 font-sans" x-data="{ mobileMenuOpen: false }">
        
        <nav class="w-full max-w-7xl mx-auto px-2 md:px-4">
            <div class="flex justify-between h-16 items-center">
                
                {{-- Logo --}} 
                <a href="{{ route('home') }}" class="flex items-center gap-2 transition hover:opacity-90 shrink-0">
                    <img src="{{ asset('assets/image/Udyantra-logo.svg') }}" 
                         alt="Udyantra" 
                         class="h-10 md:h-12 w-auto object-contain">
                </a>

                {{-- Desktop Menu Links --}}
                <div class="hidden md:flex items-center gap-6 lg:gap-8 font-semibold text-sm lg:text-base text-black">
                    <a href="#why-choose-us" class="hover:text-primary transition-colors">Why Choose Us</a>
                    <a href="#focus" class="hover:text-primary transition-colors">What We Focus On</a>
                    <a href="#pricing" class="hover:text-primary transition-colors">Pricing</a>
                    <a href="#faq" class="hover:text-primary transition-colors">FAQs</a>
                    <a href="#contact" class="hover:text-primary transition-colors">Contact Us</a>
                </div>

                {{-- Desktop Action Buttons --}}
                <div class="hidden md:flex items-center gap-6">
                    <div class="bg-primary text-white rounded-full px-6 py-2.5 flex items-center font-medium shadow-sm hover:bg-primary-light transition duration-200">
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
                    <button @click="mobileMenuOpen = !mobileMenuOpen" class="text-black focus:outline-none p-2">
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
            
            <div class="px-4 py-4 space-y-2 flex flex-col font-medium text-black">
                {{-- Login/Register at Top --}}
                <div class="pb-2 border-b border-gray-100 mb-2">
                    @if(session('api_token'))
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
                            <a href="{{ route('register') }}" class="flex items-center justify-center gap-2 bg-primary text-white py-2.5 rounded-lg font-semibold">
                                <x-lucide-user-plus class="w-4 h-4" />
                                Register
                            </a>
                        </div>
                    @endif
                </div>

                {{-- Mobile Links --}}
                <a href="#why-choose-us" class="block px-3 py-2 rounded-md active:text-primary transition">Why Choose Us</a>
                <a href="#focus" class="block px-3 py-2 rounded-md active:text-primary transition">What We Focus On</a>
                <a href="#pricing" class="block px-3 py-2 rounded-md active:text-primary transition">Pricing</a>
                <a href="#faq" class="block px-3 py-2 rounded-md active:text-primary transition">FAQs</a>
                <a href="#contact" class="block px-3 py-2 rounded-md active:text-primary transition">Contact Us</a>
            </div>
        </div>
    </header>