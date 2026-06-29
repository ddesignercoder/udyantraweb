{{-- HEADER --}}
    <header class="bg-white  sticky top-0 z-50 font-sans">
        <nav class="w-full max-w-7xl mx-auto px-4 md:px-6">
            <div class="flex justify-center h-16 items-center">
                
                {{-- Logo --}} 
                <div class="flex items-center gap-3 md:gap-4 shrink-0">
                    <a href="#" class="flex items-center transition hover:opacity-90">
                        <img src="{{ asset('assets/image/Udyantra-logo.svg') }}" 
                             alt="Udyantra" 
                             class="h-16 w-auto object-contain">
                    </a>
                    
                    @if(isset($organization) && !empty($organization['brand_logo_url']) && (!isset($organization['brand_enabled']) || $organization['brand_enabled']))
                        <div class="h-8 w-px bg-gray-300"></div>
                        <div class="flex items-center">
                            <img src="{{ asset('udyantra-storage/' . $organization['brand_logo_url']) }}" 
                                 alt="{{ $organization['name'] }} Logo" 
                                 class="h-12 w-auto object-contain max-w-[150px]">
                        </div>
                    @endif
                </div>

                {{-- Action Button (Login/Logout) --}}
                {{-- <div class="flex items-center gap-4">
                    <div class="bg-primary text-white rounded-full px-6 py-2.5 flex items-center font-medium shadow-sm hover:bg-primary-light transition duration-200">
                        @if(session('api_token'))
                            <form method="POST" action="{{ route('logout') }}" class="flex items-center m-0">
                                @csrf
                                <button type="submit" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">
                                    Logout
                                </button>
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="hover:underline text-sm md:text-base whitespace-nowrap cursor-pointer">Login</a>
                        @endif
                    </div>
                </div> --}}

            </div>
        </nav>
    </header>