@extends('layouts.dashboard')

@section('title', 'Buy Packages')

@section('content')
    <div class="max-w-7xl mx-auto relative">
        
        {{-- Header Section --}}
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">Select a Package</h1>
                <p class="text-textBlack text-lg md:text-xl leading-tight">Choose a plan that suits your assessment needs.</p>
            </div>
            <a href="{{ route('dashboard.my-purchases') }}" 
               class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-primary border border-primary font-medium py-2.5 px-5 rounded-lg transition-colors duration-200">
                <x-lucide-history class="w-4 h-4" />
                <span>My Purchases</span>
            </a>
        </div>

        {{-- Content with Tabs --}}
        @php
            $firstCategory = array_key_first($groupedPackages) ?? 'JUNIOR';
        @endphp

        <div x-data="{ activeTab: '{{ $firstCategory }}' }">

            {{-- Tabs Navigation --}}
            <div class="flex space-x-1 rounded-lg bg-lightgray p-1 mb-8 w-fit">
                @foreach($groupedPackages as $category => $packages)
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

            {{-- Tab Panels --}}
            @foreach($groupedPackages as $category => $packages)
                <div x-show="activeTab === '{{ $category }}'" 
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 transform scale-95"
                     x-transition:enter-end="opacity-100 transform scale-100"
                     class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

                    @foreach($packages as $package)
                        {{-- Package Card --}}
                        <div class="bg-white rounded-lg shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300 overflow-hidden flex flex-col relative">
                            
                            @if($package['test_count'] >= 100)
                                <div class="absolute top-0 right-0 bg-primary text-white text-xs font-bold px-3 py-1 rounded-bl-lg">
                                    Best Value
                                </div>
                            @endif

                            <div class="p-6 grow">
                                {{-- Header --}}
                                <div class="mb-4">
                                    <h3 class="text-lg font-semibold text-black">{{ $package['name'] }}</h3>
                                    <div class="inline-flex items-center gap-1.5 mt-2 px-3 py-1 rounded-full bg-teal-50 text-primary text-xs font-medium">
                                        <x-lucide-file-text class="w-3.5 h-3.5" />
                                        {{ $package['test_count'] }} Tests
                                    </div>
                                </div>

                                {{-- Price Section --}}
                                <div class="mb-4">
                                    <div class="flex items-baseline gap-1">
                                        <span class="text-2xl font-bold text-gray-900">₹{{ number_format((float)$package['price'], 0) }}</span>
                                        <span class="text-sm text-gray-500">/ pack</span>
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        Validity: {{ $package['time_period'] }} {{ $package['time_period'] > 1 ? 'Months' : 'Month' }}
                                    </div>
                                    <div class="text-xs text-gray-400 mt-1">
                                        (₹{{ number_format((float)$package['unit_price'], 0) }} per test)
                                    </div>
                                {{--    <div class="text-xs text-gray-400 mt-0.5">
                                        + {{ number_format((float)$package['gst'], 0) }}% GST included
                                    </div>--}}
                                </div>
                                <div class="">
                                <button type="button" 
                                        onclick="initiatePayment({{ $package['id'] }})"
                                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark/80 text-white font-medium py-2.5 px-4 rounded-full transition-colors duration-200 cursor-pointer">
                                    <span class="text-textWhite leading-relaxed max-w-xl">Buy Now</span>
                                    <x-lucide-arrow-right class="w-4 h-4" />
                                </button>
                            </div>
                            </div>

                            {{-- Footer / Action --}}
                            <!-- <div class="p-6 pt-0 mt-auto">
                                <button type="button" 
                                        onclick="initiatePayment({{ $package['id'] }})"
                                        class="w-full flex items-center justify-center gap-2 bg-primary hover:bg-primary-dark/80 text-white font-medium py-2.5 px-4 rounded-xl transition-colors duration-200 cursor-pointer">
                                    <span>Buy Now</span>
                                    <x-lucide-arrow-right class="w-4 h-4" />
                                </button>
                            </div> -->
                        </div>
                    @endforeach

                </div>
            @endforeach

            {{-- Empty State --}}
            @if(empty($groupedPackages))
                <div class="text-center py-12">
                    <div class="bg-gray-100 rounded-full h-16 w-16 flex items-center justify-center mx-auto mb-4">
                        <x-lucide-package-open class="h-8 w-8 text-gray-400" />
                    </div>
                    <h3 class="text-lg font-medium text-gray-900">No Packages Found</h3>
                    <p class="text-gray-500 mt-1">Please check back later for new assessment plans.</p>
                </div>
            @endif

        </div>

        {{-- PAYMENT LOADER (Hidden by default) --}}
        <div id="payment-loader" class="fixed inset-0 z-50 hidden flex-col items-center justify-center backdrop-blur-md bg-white/30 transition-opacity duration-300">
            <div class="bg-white p-8 rounded-2xl shadow-2xl flex flex-col items-center max-w-sm w-full mx-4 animate-fade-in border border-gray-100">
                <svg class="animate-spin h-12 w-12 text-primary mb-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <h3 class="text-lg font-bold text-gray-900 mb-1">Processing Payment</h3>
                <p id="loader-text" class="text-gray-500 text-sm text-center">Connecting to Payment Gateway...</p>
            </div>
        </div>

    </div>

    {{-- PAYMENT SCRIPTS --}}
    {{-- Razorpay SDK --}}
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>

    {{-- Custom Payment Logic --}}
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
                            "ondismiss": function(){ 
                                // Optional: Handle modal close without payment
                            }
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
                    alert("Error: " + (response.data.message || "Unknown error"));
                }
            })
            .catch(function (error) {
                hideLoader();
                console.error(error);

                let msg = "Could not initiate payment.";
                if(error.response && error.response.data && error.response.data.message) {
                    msg = error.response.data.message;
                }
                alert(msg);
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
                    alert("Payment Verification Failed: " + response.data.message);
                }
            })
            .catch(function (error) {
                hideLoader();
                alert("Server error during verification.");
            });
        }
    </script>
@endsection