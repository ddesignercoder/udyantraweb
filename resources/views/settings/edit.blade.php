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

            </nav>

        {{-- CONTENT AREA --}}
        <div>
            @if(request()->routeIs('profile.password'))
                <x-dashboard.password />
            @else
                <x-dashboard.profile :role="$role" :data="$data" />
            @endif
        </div>

    </div>
</div>
@endsection