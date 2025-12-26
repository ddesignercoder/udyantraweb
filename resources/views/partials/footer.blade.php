    {{-- FOOTER --}}
    <footer class="relative bg-primary text-white py-6 md:py-8 px-4 md:px-6 overflow-hidden font-sans">
        
        {{-- 1. Background Leaf Decoration (Right Side) --}}
        <div class="absolute bottom-[4%] right-[1%]  md:bottom-[2%] lg:top-[1%] md:right[1%] pointer-events-none opacity-27 w-[320px] sm:w-[400px] md:w-[480px] lg:w-[500px] z-0">
            <img src="{{ asset('assets/image/home/logo-symbol.svg') }}" 
                 alt="Background Leaf" 
                 class="w-full h-auto object-contain ">
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-8 md:mb-12">

                {{-- COLUMN 1: Brand & Description --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-4 space-y-1">
                    {{-- Logo --}}
                    <a href="{{ route('home') }}" class="inline-block">
                        <img src="{{ asset('assets/image/footer-logo.svg') }}" 
                             alt="Udyantra" 
                             class="h-12 w-auto object-contain">
                    </a>
                    
                    <p class="text-white text-sm leading-relaxed pr-0 md:pr-12 text-justify">
                        Udyantra is the platform for experts and businesses who take education seriously. 
                        In a world where anyone can ask AI for information, we're the home for those who 
                        educate with purpose, modernity, and humanity. We power human-led learning that 
                        drives student trust, connection, and results.
                    </p>
                </div>

                {{-- COLUMN 2: Quick Links --}}
                <div class="col-span-6 md:col-span-6 lg:col-span-3">
                    <h3 class="text-lg font-bold mb-2 md:mb-6">Quick links</h3>
                    <ul class="space-y-3 text-sm font-medium text-white/90">
                        <li><a href="{{ route('home') }}" class="hover:text-white hover:underline transition">Home</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">About us</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Pricing</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Blog</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Contact</a></li>
                    </ul>
                </div>

                {{-- COLUMN 3: Policies --}}
                <div class="col-span-6 md:col-span-6 lg:col-span-2">
                    <h3 class="text-lg font-bold mb-2 md:mb-6">Policies</h3>
                    <ul class="space-y-3 text-sm font-medium text-white/90">
                        <li><a href="#" class="hover:text-white hover:underline transition">Terms of use</a></li>
                        <li><a href="#" class="hover:text-white hover:underline transition">Privacy policy</a></li>
                    </ul>
                </div>

                {{-- COLUMN 4: Follow Us --}}
                <div class="col-span-12 md:col-span-6 lg:col-span-3">
                    <h3 class="text-lg font-bold mb-2 md:mb-6">Follow Us</h3>
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
