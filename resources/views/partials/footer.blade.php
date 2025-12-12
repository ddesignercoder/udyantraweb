<footer class="relative bg-[#00AAD9] text-white pt-8 pb-8 px-4 md:px-6 overflow-hidden font-sans">
    
    {{-- 1. Background Leaf Decoration (Right Side) --}}
    <div class="absolute bottom-[-8%] left-[65%] pointer-events-none opacity-80 w-[300px] md:w-[480px] z-0">
        <img src="{{ asset('assets/image/home/logo-symbol.png') }}" 
             alt="Background Leaf" 
             class="w-full h-auto object-contain ">
    </div>

    <div class="relative z-10 max-w-7xl mx-auto">
        <div class="grid grid-cols-1 md:grid-cols-12 gap-12 mb-12">

            {{-- COLUMN 1: Brand & Description --}}
            <div class="md:col-span-5 space-y-6">
                {{-- Logo (Using brightness-0 invert to make it white if it's a transparent PNG) --}}
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
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path></svg>
                    </a>
                    
                    {{-- Instagram --}}
                    <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>
                    </a>

                    {{-- X (Twitter) --}}
                    <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"></path></svg>
                    </a>

                    {{-- YouTube --}}
                    <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"></path></svg>
                    </a>

                    {{-- LinkedIn --}}
                    <a href="#" class="bg-white/10 hover:bg-white/20 p-2 rounded-full transition text-white">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z"></path><circle cx="4" cy="4" r="2"></circle></svg>
                    </a>
                </div>
            </div>

        </div>
        
    </div>
</footer>