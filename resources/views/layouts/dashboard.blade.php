<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - Udyantra</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/image/favicon.png') }}"> 
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans" x-data="{ sidebarOpen: false }">

    {{-- TOP NAVIGATION --}}
    <nav class="bg-white shadow-sm border-b border-gray-200 fixed w-full z-30">
        <div class="px-4 py-3 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <button @click="sidebarOpen = !sidebarOpen" class="text-black hover:text-primary md:hidden">
                    <x-lucide-menu class="w-6 h-6" />
                </button> 
                <a href="{{ route('home') }}">
                  <img src="{{ asset('assets/image/Udyantra-logo.svg') }}" 
                       alt="Udyantra" 
                       class="h-8 w-auto object-contain">
                </a>
            </div>
            
            {{-- Right side empty (User profile moved to sidebar) --}}
            <div class="flex items-center gap-4">
            </div>
        </div>
    </nav>

    {{-- MAIN LAYOUT --}}
    <div class="flex pt-16 h-screen overflow-hidden">
        
        {{-- SIDEBAR --}}
        {{-- Added 'flex flex-col h-full' to enable sticky bottom section --}}
        {{-- Increased z-index to z-40 so the popup appears above other content if needed --}}
        <aside class="fixed inset-y-0 left-0 z-40 w-64 bg-teal-50 border-r border-gray-200 transform transition-transform duration-300 md:translate-x-0 md:static md:h-full flex flex-col"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            {{-- MENU CONTAINER (Takes available space & scrolls) --}}
            <div class="flex-1 overflow-y-auto p-4 mt-12 md:mt-0">
                <nav class="space-y-1">
                    
                    @forelse($menuItems as $item)
                        @php
                            $url = Route::has($item['route']) ? route($item['route']) : '#';
                            $isActive = Route::has($item['route']) && request()->routeIs($item['route']);
                            $baseClass = "flex items-center gap-3 px-3 py-2 rounded-lg transition cursor-pointer";
                            $activeClass = "bg-blue-50 text-primary font-medium";
                            $inactiveClass = "text-gray-700 hover:bg-gray-100";
                        @endphp

                        <a href="{{ $url }}" 
                           class="{{ $baseClass }} {{ $isActive ? $activeClass : $inactiveClass }}">
                            <x-dynamic-component 
                                :component="'lucide-'.$item['icon']" 
                                class="w-5 h-5 {{ $isActive ? 'text-primary' : 'text-black' }}" 
                            />
                            {{ $item['label'] }}
                        </a>
                    @empty
                        <div class="px-4 py-2 text-sm text-red-400">
                            Menu unavailable
                        </div>
                    @endforelse

                </nav>
            </div>
            <x-dashboard.settings/>           
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="font-sans flex-1 overflow-y-auto bg-gray-50 p-4 md:p-4" @click="sidebarOpen = false">
            @yield('content')
        </main>

    </div>

    @include('partials.toast-script')
</body>
</html>