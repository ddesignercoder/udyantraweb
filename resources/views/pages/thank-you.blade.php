@extends('layouts.app')
@section('title', 'Thank You')
@section('content')
<div class="min-h-screen bg-gray-50 flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full bg-white rounded-xl shadow-lg overflow-hidden">
        
        {{-- Success Header --}}
        <div class="bg-green-600 px-6 py-8 text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                <svg class="h-10 w-10 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h2 class="text-3xl font-extrabold text-white">Payment Successful!</h2>
            <p class="text-green-100 mt-2">Thank you for your purchase.</p>
        </div>

        {{-- Receipt Details --}}
        <div class="px-6 py-8">
            <div class="border-b border-gray-200 pb-6 mb-6">
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Payment ID</span>
                    <span class="font-medium text-gray-900">{{ $transaction['razorpay_payment_id'] }}</span>
                </div>
                <div class="flex justify-between mb-4">
                    <span class="text-gray-600">Order ID</span>
                    <span class="font-medium text-gray-900 text-sm">{{ $transaction['razorpay_order_id'] }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-600">Date</span>
                    <span class="font-medium text-gray-900">
                        {{ \Carbon\Carbon::parse($transaction['created_at'])->format('d M Y, h:i A') }}
                    </span>
                </div>
            </div>

            {{-- Item Details --}}
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <div class="flex justify-between items-center mb-2">
                    <span class="font-bold text-gray-800">{{ $transaction['package']['name'] }}</span>
                    <span class="font-bold text-gray-800">₹{{ number_format($transaction['amount'], 2) }}</span>
                </div>
                <div class="text-sm text-gray-500">
                    Category: {{ $transaction['package']['category'] }}
                </div>
            </div>

            {{-- Action Buttons --}}
            <div class="space-y-3">
                <a href="{{ url('/welcome') }}" class="w-full flex justify-center py-3 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Go to Dashboard
                </a>
                <a href="{{ route('udyantra-package') }}" class="w-full flex justify-center py-3 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none">
                    Buy Another Package
                </a>
            </div>
        </div>
    </div>
</div>
@endsection