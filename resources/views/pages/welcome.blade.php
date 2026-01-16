@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<div class="min-h-[80vh] flex-col items-center justify-center bg-input-bg py-2 px-4 sm:px-6 lg:px-8">
    {{-- SECTION 7: PRICING / PLANS (Linked from Hero) --}}
    <section id="plans" class="py-2 bg-gray-50 font-sans">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            {{-- OPTIONAL: Quick Dev Link (You can remove this later) --}}
            <div class="flex justify-center gap-4 mb-6">
                <a href="{{ route('test-panel', ['slug' => 'professional-psychometric-6961eef65d70c']) }}" 
                   target="_blank"
                   class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
                    🚀 Launch Demo Test (Direct Link)
                </a>
                <a href="{{ route('user.dashboard') }}" class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
                   Test Results Dashboard
                </a>
            </div>

            <div class="text-center max-w-5xl mx-auto mb-4">
                <h2 class="text-3xl md:text-5xl font-serif text-gray-900 mb-4">
                   Hi, {{ session('user_name', 'Creator') }}!
                </h2>
                <div>
                    <a href="{{ route('udyantra-package') }}" 
                        class="bg-indigo-600 text-white px-4 py-2 rounded shadow hover:bg-indigo-700 transition">
                        Package
                    </a>
                </div>
                <!-- <p class="text-gray-600 text-lg">
                    Comprehensive assessments tailored for your career stage.
                </p> -->
            </div>

        </div>
    </section>

</div>
@endsection