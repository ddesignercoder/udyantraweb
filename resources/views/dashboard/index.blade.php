@extends('layouts.dashboard')

@section('title', $config['title'])

@section('content')

    <div class="mb-8">
        <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">{{ $config['title'] }}</h1>
        <p class="text-textBlack text-lg md:text-xl leading-tight">Welcome back, {{ $user_name }}!</p>
    </div>

    @if(in_array($role, ['school_admin', 'company_admin']))
        <div class="bg-white p-5 rounded-xl shadow-sm border border-primary-light mb-8 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
            <div>
                <h3 class="text-primary text-base font-semibold">Self-Registration Link</h3>
                <p class="text-textBlack text-sm mt-1">Get the unique registration link to invite members to self-register under your organization.</p>
            </div>
            <a href="{{ route('dashboard.invite-members') }}" class="bg-primary hover:bg-primary-dark text-white px-5 py-2.5 rounded-full font-bold transition text-sm shrink-0 flex items-center gap-1.5 cursor-pointer">
                <x-lucide-share-2 class="w-4 h-4" />
                Get Invite Link
            </a>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        @foreach($config['widgets'] as $widget)
            <div class="bg-white p-4 md:p-6 rounded-xl shadow-sm border border-primary-light flex items-center gap-4">
                @if(isset($widget['icon']))
                    <div class="text-primary bg-white p-2 rounded-full  mb-4">
                        <x-dynamic-component :component="'lucide-'.$widget['icon']" class="w-8 h-8" />
                    </div>
                @endif
                <div>
                    <h3 class="text-primary text-lg font-medium">{{ $widget['label'] }}</h3>
                    <p class="text-2xl font-bold text-textBlack mt-1">{{ $widget['value'] }}</p>
                </div>
            </div>
        @endforeach
    </div>

@endsection