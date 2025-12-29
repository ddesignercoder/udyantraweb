@extends('layouts.app') 
@section('title', 'Udyantra Package')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@section('content')
<div class="min-h-screen bg-gray-50 font-sans pt-16 lg:pt-22 text-textBlack" 
     x-data="{ activeCategory: '{{ array_key_first($groupedPackages) }}' }">

    {{-- Header Section --}}
    <div class="bg-gray-50 ">
        <div class="container mx-auto px-4 text-center">
            <h1 class="text-3xl md:text-4xl font-sans font-semibold mb-8 md:mb-10">
                Select Your Package
            </h1>

            <div class="inline-flex flex-wrap justify-center gap-4 bg-primary p-1.5 rounded-xl border border-gray-200">
                @foreach($groupedPackages as $category => $packages)
                    <label class="cursor-pointer relative">
                        <input type="radio" 
                               name="category_filter" 
                               value="{{ $category }}" 
                               x-model="activeCategory"
                               class="peer sr-only">
                        
                        {{-- Visual Button Style --}}
                        <div class="px-6 py-2.5 rounded-lg text-sm font-semibold text-gray-100 transition-all duration-200
                                    hover:bg-white hover:text-primary
                                    peer-checked:bg-white peer-checked:text-primary peer-checked:shadow-sm peer-checked:ring-1 peer-checked:ring-gray-200">
                            {{ ucfirst(strtolower($category)) }} Packages
                        </div>
                    </label>
                @endforeach
            </div>

        </div>
    </div>

    {{-- Content Section --}}
    <div class="container mx-auto px-4 pt-10 pb-22">
        
        @foreach($groupedPackages as $category => $packages)
            <div x-show="activeCategory == '{{ $category }}'" 
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-y-4"
                 x-transition:enter-end="opacity-100 translate-y-0"
                 class="">
                
                {{-- Category Title --}}
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-8 w-1.5 bg-secondary rounded-full"></div>
                    <h2 class="text-2xl font-bold text-gray-800 tracking-tight">
                        {{ ucfirst(strtolower($category)) }} Packages
                    </h2>
                </div>

                {{-- Grid Layout --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                    @foreach($packages as $package)
                        <div class="group relative flex flex-col bg-white rounded-2xl shadow-sm ring-1 ring-gray-200 transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden">
                            
                            {{-- Decorative Top Bar --}}
                            <div class="absolute inset-0 bg-linear-to-b from-primary to-secondary opacity-0 group-hover:opacity-100 transition-opacity duration-300 z-0"></div>

                            <div class="p-8 grow relative z-10">
                                <h3 class="text-lg font-bold text-gray-900 group-hover:text-primary transition-colors mb-2 group-hover:text-white">
                                    {{ $package['name'] }}
                                </h3>

                                <div class="inline-flex items-center gap-1.5 rounded-full bg-teal-50 px-3 py-1 text-xs font-medium text-primary border border-teal-100 mb-6">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $package['test_count'] }} Tests Included
                                </div>

                                <div class="flex items-baseline gap-1">
                                    <span class="text-4xl font-extrabold tracking-tight text-gray-900 group-hover:text-white">
                                        ₹{{ number_format((float)$package['price'], 0) }}
                                    </span>
                                    <span class="text-sm font-semibold text-gray-400  group-hover:text-white">/ pack</span>
                                </div>
                                <p class="text-xs text-gray-400 mt-1 group-hover:text-white">(Inclusive of GST)</p>

                                {{-- Feature List --}}
                                <ul class="mt-6 space-y-3 text-sm text-gray-700 group-hover:text-white">
                                    <li class="flex items-center gap-3 group-hover:text-white">
                                        <svg class="h-5 w-5 flex-none text-secondary group-hover:text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        Valid for {{ ucfirst(strtolower($category)) }} level
                                    </li>
                                    <li class="flex items-center gap-3 group-hover:text-white">
                                        <svg class="h-5 w-5 flex-none text-secondary  group-hover:text-white" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" /></svg>
                                        Instant Access
                                    </li>
                                </ul>
                            </div>

                            {{-- Action Area --}}
                            <div class="p-6 relative z-10 bg-gray-50 border-t border-gray-100 group-hover:bg-transparent group-hover:border-white/30 transition-colors">
                                <x-button variant="secondary" class="mt-0 w-full" onclick="initiatePayment({{ $package['id'] }})">Buy Now&nbsp;
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                </x-button>
                                
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

{{-- SECTION 5: Success Stories --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-lightgray font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-2 md:px-4">

            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Success stories from our customers
            </h2>

            {{-- MOVING CONTENT STORIES --}}
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-10 relative -mb-60 md:-mb-70 fade-sides">
                
                {{-- Carousel Logic --}}
                <x-testimonials />

            </div>
        </div>
    </section>

    {{-- Section : FAQs --}}
    <section class="font-sans relative z-0 pt-56 lg:pt-68 pb-16 lg:py-22">
        <x-faq />
    </section>

    {{-- SECTION 5: Sign Up Today --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100 font-sans relative">
        <div class="max-w-7xl mx-auto px-2 md:px-4 ">
            <div class="bg-primary-light rounded-xl shadow-xl p-4 md:p-10 g-2 relative text-center">
                <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black font-sans mb-5 md:mb-7">
                    Start earning. Register today
                </h2>
                <p class="test-base mb-0">Create, manage, and sell more.</p>

                <x-button variant="secondary" as="a" class="mt-2" href="/logout">Start For Free</x-button>
            </div>
        </div>
    </section>

<div id="payment-loader" class="fixed inset-0 z-50 hidden flex-col items-center justify-center backdrop-blur-md transition-opacity duration-300">
    
    {{-- The white modal box --}}
    <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col items-center max-w-sm w-full mx-4 animate-fade-in">
        <svg class="animate-spin h-12 w-12 text-primary mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <h3 class="text-lg font-bold text-gray-900 mb-1">Processing Payment</h3>
        <p id="loader-text" class="text-gray-500 text-sm text-center">Connecting to gateway...</p>
    </div>
</div>

{{-- SCRIPTS --}}
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
    // Helper functions for Loader
    const loader = document.getElementById('payment-loader');
    const loaderText = document.getElementById('loader-text');

    function showLoader(message = "Processing...") {
        loaderText.innerText = message;
        loader.classList.remove('hidden');
        loader.classList.add('flex');
    }

    function hideLoader() {
        loader.classList.add('hidden');
        loader.classList.remove('flex');
    }

    // Main Payment Logic
    function initiatePayment(packageId) {
        
        showLoader("Connecting to secure payment gateway...");

        if (typeof axios === 'undefined') {
            hideLoader();
            alert("System is loading resources, please try again in a moment.");
            return;
        }

        axios.post("{{ route('payment.initiate') }}", {
            package_id: packageId,
            _token: "{{ csrf_token() }}" 
        })
        .then(function (response) {
            hideLoader();

            if (response.data.status) {
                const data = response.data.data;
                
                var options = {
                    "key": data.key, 
                    "amount": data.amount, 
                    "currency": "INR",
                    "name": "Udyantra",
                    "description": "Package Purchase",
                    "order_id": data.order_id, 
                    "handler": function (response){
                        verifyPayment(response);
                    },
                    "modal": {
                        "ondismiss": function(){ }
                    },
                    "prefill": {
                        "name": data.name,
                        "email": data.email,
                        "contact": data.contact
                    },
                    "theme": {
                        "color": "#018580"
                    }
                };
                
                var rzp1 = new Razorpay(options);
                rzp1.on('payment.failed', function (response){
                    alert("Payment Failed: " + response.error.description);
                });
                rzp1.open();
            } else {
                alert("Error: " + response.data.message);
            }
        })
        .catch(function (error) {
            hideLoader();
            console.error(error);
            alert("Could not initiate payment. Please try again.");
        });
    }

    function verifyPayment(paymentData) {
        showLoader("Verifying your payment...");

        axios.post("{{ route('payment.verify') }}", {
            razorpay_order_id: paymentData.razorpay_order_id,
            razorpay_payment_id: paymentData.razorpay_payment_id,
            razorpay_signature: paymentData.razorpay_signature,
            _token: "{{ csrf_token() }}"
        })
        .then(function (response) {
            if(response.data.status) {
                loaderText.innerText = "Success! Redirecting...";
                window.location.href = "/payment/thank-you/" + paymentData.razorpay_order_id;
            } else {
                hideLoader();
                alert("Payment Verification Failed.");
            }
        })
        .catch(function (error) {
            hideLoader();
            alert("Server error during verification.");
        });
    }
</script>
@endsection