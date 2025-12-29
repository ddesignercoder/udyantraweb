    {{-- FOOTER --}}
    <footer class="relative bg-primary text-white py-16 lg:py-22 px-4 md:px-6 overflow-hidden font-sans">
        
        {{-- 1. Background Leaf Decoration (Right Side) --}}
        <div class="absolute bottom-[4%] right-[1%]  md:bottom-[2%] lg:top-[1%] md:right[1%] pointer-events-none opacity-27 w-[320px] sm:w-[400px] md:w-[480px] lg:w-[500px] z-0">
            <img src="{{ asset('assets/image/home/logo-symbol.svg') }}" 
                 alt="Background Leaf" 
                 class="w-full h-auto object-contain ">
        </div>

        <div class="relative w-full max-w-7xl mx-auto px-2 md:px-4">
            <div class="grid grid-cols-12 md:grid-cols-12 gap-8">

                {{-- COLUMN 1: Brand & Description --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-5 space-y-1">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="inline-block mt-[-10px]">
                        <img src="{{ asset('assets/image/footer-logo.svg') }}" 
                             alt="Udyantra" 
                             class="h-18 w-auto object-contain">
                    </a>
                    
                    <p class="text-white text-base leading-relaxed pr-4 md:pr-12">
                        Udyantra is the platform for experts and businesses who take education seriously. In a world where anyone can ask AI for information, we're the home for those who 
                        educate with purpose, modernity, and humanity. We power human-led learning that 
                        drives student trust, connection, and results.
                    </p>
                </div>

                {{-- COLUMN 2: Quick Links --}}
                <div class="col-span-6 md:col-span-6 lg:col-span-2">
                    <h3 class="text-lg font-bold mb-2 md:mb-6">Quick links</h3>
                    <ul class="space-y-3 text-base font-medium text-white/90">
                        <li><a href="{{ route('home') }}" class="hover:text-white hover:underline transition">Home</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">About us</a></li>
                        <li><a href="{{ route('udyantra-package') }}" class="hover:text-white hover:underline transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Contact</a></li>
                    </ul>
                </div>

                {{-- COLUMN 3: Policies --}}
                <div class="col-span-6 md:col-span-6 lg:col-span-2">
                    <h3 class="text-lg font-bold mb-2 md:mb-6">Policies</h3>
                    <ul class="space-y-3 text-base font-medium text-white/90">
                        <li><a href="#" class="hover:text-white hover:underline transition">Terms of use</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Privacy policy</a></li>
                    </ul>
                </div>

                {{-- COLUMN 4: Follow Us --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <h3 class="text-lg font-bold mb-2 md:mb-6">Follow Us</h3>
                    <div class="flex gap-4">
                        {{-- Facebook --}}
                        <a href="#" class="w-6 text-center">
                            <img src="{{ asset('assets/image/Facebook.svg') }}" 
                             alt="Facebook" 
                             class="w-5">
                        </a>
                        
                        {{-- Instagram --}}
                        <a href="#" class="w-6 text-center">
                            <img src="{{ asset('assets/image/Instagram.svg') }}" 
                             alt="Instagram" 
                             class="w-5">
                        </a>

                        {{-- X (Twitter) --}}
                        <a href="#" class="w-6 text-center">
                            <img src="{{ asset('assets/image/Twitter-X.svg') }}" 
                             alt="X" 
                             class="w-5">
                        </a>

                        {{-- YouTube --}}
                        <a href="#" class="w-6 text-center">
                            <img src="{{ asset('assets/image/Youtube.svg') }}" 
                             alt="Youtube" 
                             class="w-5">
                        </a>

                        {{-- LinkedIn --}}
                        <a href="#" class="w-6 text-center">
                            <img src="{{ asset('assets/image/Linkedin.svg') }}" 
                             alt="Linkedin" 
                             class="w-5">
                        </a>
                    </div>
                </div>

            </div>
            
        </div>
    </footer>
