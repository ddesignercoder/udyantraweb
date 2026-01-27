@extends('layouts.dashboard')

@section('title', 'My Assessment Dashboard')

@section('content')
<div class="max-w-7xl mx-auto">
    <div class="max-w-5xl mx-auto">
        
        {{-- Header --}}
        <div class="md:flex md:items-center md:justify-between mb-8">
            <div class="flex-1 min-w-0">
                <h2 class="text-2xl font-bold leading-7 text-gray-900 sm:text-3xl sm:truncate">
                    My Assessments
                </h2>
            </div>
        </div>

        {{-- Logic: Check if history exists --}}
        @if(count($history) > 0)
            
            <div class="bg-white shadow overflow-hidden sm:rounded-md">
                <ul class="divide-y divide-gray-200">
                    {{-- LOOP THROUGH DATA DIRECTLY --}}
                    @foreach($history as $item)
                        <li>
                            <div class="block hover:bg-gray-50 transition duration-150 ease-in-out">
                                <div class="px-4 py-4 sm:px-6">
                                    <div class="flex items-center justify-between">
                                        <p class="text-sm font-medium text-indigo-600 truncate">
                                            Psychometric Assessment #{{ $item['test_id'] }}
                                        </p>
                                        <div class="ml-2 shrink-0 flex">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-2 sm:flex sm:justify-between">
                                        <div class="sm:flex">
                                            <p class="flex items-center text-sm text-gray-500">
                                                {{ $item['date'] }}
                                            </p>
                                        </div>
                                        <div class="mt-2 flex items-center text-sm text-gray-500 sm:mt-0">
                                            {{-- Use Route Parameter --}}
                                            <a href="{{ route('test.result', $item['test_result_id']) }}" class="text-indigo-600 hover:text-indigo-900">
                                                View Analysis &rarr;
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

        @else
            {{-- Empty State --}}
            <div class="text-center py-12">
                <h3 class="mt-2 text-sm font-medium text-gray-900">No tests taken</h3>
                <p class="mt-1 text-sm text-gray-500">Get started by taking your first psychometric test.</p>
            </div>
        @endif

    </div>
</div>
@endsection