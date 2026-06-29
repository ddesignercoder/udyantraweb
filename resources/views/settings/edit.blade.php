@extends('layouts.dashboard') 

@section('title', 'Profile-Settings')

@section('content')
<div class="max-w-6xl mx-auto">
    
    {{-- PAGE HEADER --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Settings</h1>
        <p class="text-sm text-gray-500 mt-1">Manage your profile and account settings</p>
    </div>

    <div class="space-y-6">

        {{-- NAVIGATION TABS --}}
            <nav class="-mb-px flex space-x-8 overflow-x-auto pb-2" aria-label="Tabs">
                
                {{-- Profile Link --}}
                <a href="{{ route('profile.edit') }}" 
                   class="whitespace-nowrap group flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors
                   {{ request()->routeIs('profile.edit') 
                        ? 'border-primary text-primary' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                   
                   {{-- Icon: User --}}
                   <x-lucide-user class="mr-2 h-5 w-5 {{ request()->routeIs('profile.edit') ? 'text-primary' : 'text-black group-hover:text-primary' }}" />
                   
                   Profile
                </a>
                
                {{-- Password Link --}}
                <a href="{{ route('profile.password') }}" 
                   class="whitespace-nowrap group flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors
                   {{ request()->routeIs('profile.password') 
                        ? 'border-primary text-primary' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                   
                   {{-- Icon: Lock (or Key) --}}
                   <x-lucide-lock class="mr-2 h-5 w-5 {{ request()->routeIs('profile.password') ? 'text-primary' : 'text-black group-hover:text-primary' }}" />
                   
                   Password
                </a>

                {{-- Brand Logo Link --}}
                @if(in_array(session('user_role'), ['school_admin', 'company_admin']))
                <a href="{{ route('profile.brand-logo') }}" 
                   class="whitespace-nowrap group flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors
                   {{ request()->routeIs('profile.brand-logo') 
                        ? 'border-primary text-primary' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                   
                   {{-- Icon: Image --}}
                   <x-lucide-image class="mr-2 h-5 w-5 {{ request()->routeIs('profile.brand-logo') ? 'text-primary' : 'text-black group-hover:text-primary' }}" />
                   
                   Brand Logo
                </a>

                {{-- Brand Background Link --}}
                <a href="{{ route('profile.brand-background') }}" 
                   class="whitespace-nowrap group flex items-center py-4 px-1 border-b-2 font-medium text-sm transition-colors
                   {{ request()->routeIs('profile.brand-background') 
                        ? 'border-primary text-primary' 
                        : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }}">
                   
                   {{-- Icon: Monitor --}}
                   <x-lucide-monitor class="mr-2 h-5 w-5 {{ request()->routeIs('profile.brand-background') ? 'text-primary' : 'text-black group-hover:text-primary' }}" />
                   
                   Brand Background
                </a>
                @endif

            </nav>

        {{-- CONTENT AREA --}}
        <div>
            @if(request()->routeIs('profile.password'))
                <x-dashboard.password />
            @elseif(request()->routeIs('profile.brand-logo'))
                <x-dashboard.brand-logo :data="$data ?? []" />
            @elseif(request()->routeIs('profile.brand-background'))
                <x-dashboard.brand-background :data="$data ?? []" />
            @else
                <x-dashboard.profile :role="$role" :data="$data" />
            @endif
        </div>

    </div>
</div>
@endsection