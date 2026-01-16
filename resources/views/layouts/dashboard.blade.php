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
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </nav>

    <div class="flex pt-16 h-screen overflow-hidden">
        
        <aside class="fixed inset-y-0 left-0 z-20 w-64 bg-white border-r border-gray-200 transform transition-transform duration-300 md:translate-x-0 md:static md:h-auto overflow-y-auto"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
            
            <div class="p-4 mt-4 md:mt-0">
                <p class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-4">
                    {{ str_replace('_', ' ', session('user_role')) }} Menu
                </p>
                
                <nav class="space-y-1">
                    {{-- Common Dashboard Link --}}
                    <a href="{{ route('user.dashboard') }}" 
                       class="flex items-center gap-3 px-3 py-2 rounded-lg transition cursor-pointer 
                       {{ request()->routeIs('user.dashboard') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-700 hover:bg-gray-100' }}">
                        <x-lucide-layout-dashboard class="w-5 h-5 {{ request()->routeIs('user.dashboard') ? 'text-blue-700' : 'text-gray-500' }}" />
                        Dashboard
                    </a>
                    @if(session('user_role') === 'individual' || session('user_role') === 'school_admin' || session('user_role') === 'company_admin')
                    <a href="{{route('udyantra-package')}}" 
                       class="flex items-center gap-3 px-3 py-2 rounded-lg transition cursor-pointer 
                       {{ request()->routeIs('udyantra-package') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                        <x-lucide-package class="w-5 h-5 {{ request()->routeIs('udyantra-package') ? 'text-blue-700' : 'text-gray-500' }}" />
                        Udyantra Package
                    </a>
                    @endif

                    {{-- SCHOOL ADMIN LINKS --}}
                    @if(session('user_role') === 'school_admin')                        
                        <a href="{{ route('dashboard.list-users') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg transition cursor-pointer 
                           {{ request()->routeIs('dashboard.list-users') ? 'bg-blue-50 text-blue-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            <x-lucide-users class="w-5 h-5 {{ request()->routeIs('dashboard.list-users') ? 'text-blue-700' : 'text-gray-500' }}" />
                            Manage Students
                        </a>
                    @endif

                    {{-- COMPANY ADMIN LINKS --}}
                    @if(session('user_role') === 'company_admin')
                        <a href="{{ route('dashboard.list-users') }}" 
                           class="flex items-center gap-3 px-3 py-2 rounded-lg transition cursor-pointer 
                           {{ request()->routeIs('dashboard.list-users') ? 'bg-indigo-50 text-indigo-700 font-medium' : 'text-gray-600 hover:bg-gray-50' }}">
                            <x-lucide-briefcase class="w-5 h-5 {{ request()->routeIs('dashboard.list-users') ? 'text-indigo-700' : 'text-gray-500' }}" />
                            Manage Employees
                        </a>
                    @endif

                    {{-- STUDENT LINKS --}}
                    @if(session('user_role') === 'student')
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                            <x-lucide-pen-tool class="w-5 h-5 text-green-600" />
                            My Tests
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                            <x-lucide-award class="w-5 h-5 text-green-600" />
                            My Results
                        </a>
                    @endif

                    {{-- INDIVIDUAL LINKS --}}
                    @if(session('user_role') === 'individual')
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                            <x-lucide-search class="w-5 h-5 text-gray-600" />
                            Browse Tests
                        </a>
                        <a href="#" class="flex items-center gap-3 px-3 py-2 text-gray-600 hover:bg-gray-50 rounded-lg transition cursor-pointer">
                            <x-lucide-history class="w-5 h-5 text-gray-600" />
                            My History
                        </a>
                    @endif

                </nav>
            </div>
        </aside>

        <main class="font-sans flex-1 overflow-y-auto bg-gray-50 p-6 md:p-8" @click="sidebarOpen = false">
            @yield('content')
        </main>

    </div>

    @include('partials.toast-script')
</body>
</html>