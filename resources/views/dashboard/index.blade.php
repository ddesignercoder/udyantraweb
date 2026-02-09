@extends('layouts.dashboard')

@section('title', $config['title'])

@section('content')

    <div class="mb-8">
        <h1 class="text-2xl font-bold text-gray-900">{{ $config['title'] }}</h1>
        <p class="text-gray-600">Welcome back, {{ $user_name }}!</p>
    </div>

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

{{--    <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
        <h2 class="text-lg font-bold text-gray-800 mb-4">Quick Actions</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            @if($role === 'school_admin')
                <button class="p-4 border-2 border-primary rounded-lg text-black hover:bg-primary hover:text-white transition h-full font-medium flex items-center justify-center gap-2">
                    <x-lucide-bar-chart-4 class="w-5 h-5" />
                    View Class Reports
                </button>
            @endif


            @if($role === 'company_admin')
                <button class="p-4 border-2 border-primary rounded-lg text-black hover:bg-primary hover:text-white transition h-full font-medium flex items-center justify-center gap-2">
                    <x-lucide-bar-chart-4 class="w-5 h-5" />
                    View Employee Reports
                </button>
            @endif


            @if($role === 'individual' || $role === 'student' || $role === 'employee')
                <button class="p-4 bg-blue-600 text-white rounded-lg shadow hover:bg-blue-700 transition h-full font-semibold flex items-center justify-center gap-2">
                    <x-lucide-play-circle class="w-5 h-5" />
                    Take New Test
                </button>
            @endif --}}

        </div>
    {{--<div class="flex justify-center gap-4 mb-6">
                <a href="{{ route('test-panel', ['slug' => 'professional-69706796a435d']) }}" 
                   target="_blank"
                   class="bg-primary text-white px-4 py-2 rounded shadow hover:bg-white hover:text-primary hover:border hover:border-primary transition">
                    🚀 Launch Demo Test (Direct Link)
                </a>
                <a href="{{ route('test.report.dashboard') }}" class="bg-primary text-white px-4 py-2 rounded shadow hover:bg-white hover:text-primary hover:border hover:border-primary transition">
                   Test Results Dashboard
                </a>
        </div> --}}
    </div>

@endsection