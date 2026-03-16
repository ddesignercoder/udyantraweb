@extends('layouts.app')
@section('title', 'Payment Failed')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Failed Header --}}
        <div class="bg-red-600 px-6 py-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                <svg class="h-10 w-10 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-white">Payment Failed</h2>
            <p class="text-red-100 mt-2">Your payment could not be processed.</p>
        </div>

        {{-- Receipt Details --}}
        <div class="px-6 py-8">
            @if(request()->has('error') || isset($transaction['json_response']['message']))
            <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 rounded">
                <p class="text-sm text-red-700">
                    <strong>Reason:</strong> {{ request('error') ?? ($transaction['json_response']['message'] ?? 'Unknown error') }}
                </p>
            </div>
            @endif

            <div class="border-b border-gray-200 pb-6 mb-6">
                @if(isset($transaction['gateway_payment_id']))
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Payment ID</span>
                    <span class="font-medium text-gray-900">{{ $transaction['gateway_payment_id'] }}</span>
                </div>
                @endif
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Order ID</span>
                    <span class="font-medium text-gray-900 text-sm">{{ $transaction['gateway_order_id'] ?? request('orderId') }}</span>
                </div>
                @if(isset($transaction['created_at']))
                <div class="flex justify-between">
                    <span class="text-gray-600">Date</span>
                    <span class="font-medium text-gray-900">
                        {{ \Carbon\Carbon::parse($transaction['created_at'])->format('d M Y, h:i A') }}
                    </span>
                </div>
                @endif
            </div>

            {{-- Item Details --}}
            @if(isset($transaction['package']))
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-bold text-gray-800">{{ $transaction['package']['name'] }}</span>
                    <span class="font-bold text-gray-800">₹{{ number_format($transaction['amount'], 2) }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    Category: {{ $transaction['package']['category'] }}
                </div>
            </div>
            @endif

            {{-- Action Buttons --}}
            <div class="space-y-3">
                <a href="{{ route('dashboard.packages') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary hover:bg-primary/80 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Try Payment Again
                </a>
                <a href="{{ route('user.dashboard') }}" class="w-full flex justify-center py-3 px-4 border border-primary rounded-md shadow-sm text-sm font-medium text-primary bg-white hover:bg-primary hover:text-white focus:outline-none">
                    Go to Dashboard
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
