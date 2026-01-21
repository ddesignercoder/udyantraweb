@extends('layouts.dashboard')

@section('title', 'Package Order History')

@section('content')
    <div class="max-w-7xl mx-auto">
        
        {{-- Header Section --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-gray-900">My Purchase History</h1>
            <p class="text-gray-600 mt-1">View all your package purchases and their status.</p>
        </div>

        {{-- Purchase History by Category --}}
        @if(!empty($groupedPurchases) && count($groupedPurchases) > 0)
            
            @php
                $firstCategory = array_key_first($groupedPurchases) ?? 'JUNIOR';
            @endphp

            <div x-data="{ activeTab: '{{ $firstCategory }}' }">
                
                {{-- Category Tabs --}}
                <div class="flex space-x-1 rounded-xl bg-lightgray p-1 mb-8 w-fit">
                    @foreach($groupedPurchases as $category => $purchases)
                        <button 
                            @click="activeTab = '{{ $category }}'"
                            :class="activeTab === '{{ $category }}' 
                                ? 'bg-white text-primary shadow border border-primary' 
                                : 'text-black hover:bg-white/12 hover:text-primary hover:cursor-pointer'"
                            class="px-6 py-2.5 text-sm font-medium leading-5 rounded-lg transition-all duration-200 capitalize focus:outline-none">
                            {{ ucfirst(strtolower($category)) }} Level
                        </button>
                    @endforeach
                </div>

                {{-- Category Panels --}}
                @foreach($groupedPurchases as $category => $purchases)
                    <div x-show="activeTab === '{{ $category }}'" 
                         x-transition:enter="transition ease-out duration-300"
                         x-transition:enter-start="opacity-0 transform scale-95"
                         x-transition:enter-end="opacity-100 transform scale-100"
                         class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        
                        @foreach($purchases as $purchase)
                            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 overflow-hidden">
                                
                                {{-- Card Header with Status Badge --}}
                                <div class="bg-gradient-to-r from-primary to-secondary p-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold text-white">{{ $purchase['package_name'] }}</h3>
                                        @if($purchase['is_active'])
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-white/20 text-white text-xs font-medium backdrop-blur-sm">
                                                <x-lucide-check-circle class="w-3.5 h-3.5" />
                                                Active
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-red-500/20 text-white text-xs font-medium backdrop-blur-sm">
                                                <x-lucide-x-circle class="w-3.5 h-3.5" />
                                                Expired
                                            </span>
                                        @endif
                                    </div>
                                    <div class="mt-2">
                                        <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-white/20 text-white text-xs font-medium backdrop-blur-sm capitalize">
                                            {{ ucfirst(strtolower($purchase['category'])) }} Level
                                        </span>
                                    </div>
                                </div>

                                {{-- Card Body --}}
                                <div class="p-6">
                                    
                                    {{-- Test Count --}}
                                    <div class="flex items-center gap-3 mb-4 pb-4 border-b border-gray-100">
                                        <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-teal-50">
                                            <x-lucide-file-text class="w-6 h-6 text-primary" />
                                        </div>
                                        <div>
                                            <p class="text-sm text-gray-500">Total Tests</p>
                                            <p class="text-xl font-bold text-gray-900">{{ $purchase['test_count'] }}</p>
                                        </div>
                                    </div>

                                    {{-- Expiry Date --}}
                                    <div class="flex items-start gap-3 mb-3">
                                        <x-lucide-calendar class="w-5 h-5 text-gray-400 mt-0.5" />
                                        <div>
                                            <p class="text-sm text-gray-500">Expiry Date</p>
                                            <p class="text-sm font-medium text-gray-900">
                                                {{ \Carbon\Carbon::parse($purchase['expiry_date'])->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>

                                    {{-- Days Remaining --}}
                                    <div class="flex items-start gap-3">
                                        <x-lucide-clock class="w-5 h-5 text-gray-400 mt-0.5" />
                                        <div>
                                            <p class="text-sm text-gray-500">Days Remaining</p>
                                            @if($purchase['is_active'])
                                                @if($purchase['days_remaining'] > 30)
                                                    <p class="text-sm font-medium text-green-600">
                                                        {{ $purchase['days_remaining'] }} days
                                                    </p>
                                                @elseif($purchase['days_remaining'] > 7)
                                                    <p class="text-sm font-medium text-yellow-600">
                                                        {{ $purchase['days_remaining'] }} days
                                                    </p>
                                                @else
                                                    <p class="text-sm font-medium text-red-600">
                                                        {{ $purchase['days_remaining'] }} days (Expiring Soon!)
                                                    </p>
                                                @endif
                                            @else
                                                <p class="text-sm font-medium text-red-600">Expired</p>
                                            @endif
                                        </div>
                                    </div>

                                </div>

                            </div>
                        @endforeach
                        
                    </div>
                @endforeach

            </div>
        @else
            {{-- Empty State --}}
            <div class="text-center py-12 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="bg-gray-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                    <x-lucide-shopping-bag class="h-8 w-8 text-gray-400" />
                </div>
                <h3 class="text-lg font-medium text-gray-900">No Purchases Yet</h3>
                <p class="text-gray-500 mt-1 mb-6">You haven't purchased any packages yet.</p>
                <a href="{{ route('dashboard.packages') }}" 
                   class="inline-flex items-center gap-2 bg-primary hover:bg-primary-dark/80 text-white font-medium py-2.5 px-6 rounded-xl transition-colors duration-200">
                    <x-lucide-shopping-cart class="w-4 h-4" />
                    <span>Browse Packages</span>
                </a>
            </div>
        @endif

    </div>
@endsection  