<nav class="bg-white text-gray-800 shadow-md sticky top-0 z-50 font-sans">
    <div class="w-full max-w-7xl mx-auto px-2 md:px-4">
        <div class="flex justify-between h-16 items-center">
            
            {{-- Logo --}}
            <a href="{{ route('home') }}" class="flex items-center gap-2 transition hover:opacity-90 shrink-0">
                <img src="{{ asset('assets/image/Udyantra-Logo.png') }}" 
                     alt="Udyantra" 
                     class="h-10 md:h-12 w-auto object-contain">
            </a>

            {{-- Menu Links --}}
            <div class="hidden md:flex items-center gap-6 lg:gap-8 font-semibold text-sm lg:text-base text-black">
                <a href="#" class="hover:text-[#00AAD9] transition-colors">Why Choose Us</a>
                <a href="#" class="hover:text-[#00AAD9] transition-colors">What We Focus On</a>
                <a href="#" class="hover:text-[#00AAD9] transition-colors">Pricing</a>
                <a href="#" class="hover:text-[#00AAD9] transition-colors">FAQs</a>
                <a href="#" class="hover:text-[#00AAD9] transition-colors">Contact Us</a>
            </div>

            {{-- Action Buttons --}}
            <div class="flex items-center gap-6">
                <div class="bg-[#00AAD9] text-white rounded-full px-6 py-2.5 flex items-center font-medium shadow-sm hover:bg-[#00a0c9] transition duration-200">
                    
                    @if(session('api_token'))
                        <form method="POST" action="{{ route('logout') }}" class="flex items-center">
                            @csrf
                            <button type="submit" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">
                                Logout
                            </button>
                        </form>
                    @else
                        <a href="{{ route('login') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">
                            Creater login
                        </a>
                        <span class="mx-2 opacity-100">|</span>
                        <a href="{{ route('register') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">
                            Register
                        </a>
                    @endif
                    
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div class="md:hidden flex items-center">
                <button class="text-gray-600 focus:outline-none">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

        </div>
    </div>
</nav>