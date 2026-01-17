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
            
            <div class="flex items-center gap-4">
                <span class="text-sm font-medium text-gray-700">Hello, {{ session('user_name') }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-red-600 hover:text-red-800 font-medium flex items-center gap-1 cursor-pointer">
                        <x-lucide-log-out class="w-4 h-4" />
                    </button>
                </form>
            </div>
        </div>
    </nav>

    {{-- MAIN LAYOUT --}}
    <div class="flex pt-16 h-screen overflow-hidden">
        
        {{-- SIDEBAR --}}
        <aside class="fixed inset-y-0 left-0 z-20 w-64 bg-teal-50 border-r border-gray-200 transform transition-transform duration-300 md:translate-x-0 md:static md:h-auto overflow-y-auto"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="p-4 mt-12 md:mt-0">
                <nav class="space-y-1">
                    
                    {{-- DYNAMIC MENU LOOP --}}
                    {{-- $menuItems is injected via AppServiceProvider --}}
                    @forelse($menuItems as $item)
                        @php
                            // 1. Safe Route Generation
                            // If route doesn't exist in web.php yet, fallback to '#'
                            $url = Route::has($item['route']) ? route($item['route']) : '#';

                            // 2. Active State Logic
                            // Check if current page matches the menu item route
                            $isActive = Route::has($item['route']) && request()->routeIs($item['route']);

                            // 3. Styling Classes
                            $baseClass = "flex items-center gap-3 px-3 py-2 rounded-lg transition cursor-pointer";
                            $activeClass = "bg-blue-50 text-primary font-medium";
                            $inactiveClass = "text-gray-700 hover:bg-gray-100";
                        @endphp

                        <a href="{{ $url }}" 
                           class="{{ $baseClass }} {{ $isActive ? $activeClass : $inactiveClass }}">
                            
                            {{-- Dynamic Icon Rendering --}}
                            {{-- Assumes you are using 'blade-lucide-icons' --}}
                            <x-dynamic-component 
                                :component="'lucide-'.$item['icon']" 
                                class="w-5 h-5 {{ $isActive ? 'text-primary' : 'text-black' }}" 
                            />
                            
                            {{ $item['label'] }}
                        </a>
                    @empty
                        {{-- Fallback if API fails or no items found --}}
                        <div class="px-4 py-2 text-sm text-red-400">
                            Menu unavailable
                        </div>
                    @endforelse

                </nav>
            </div>
        </aside>

        {{-- MAIN CONTENT --}}
        <main class="font-sans flex-1 overflow-y-auto bg-gray-50 p-6 md:p-8" @click="sidebarOpen = false">
            @yield('content')
        </main>

    </div>

    @include('partials.toast-script')
</body>
</html>