@extends('layouts.app') 
@section('title', 'Why Choose Us')

<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

@section('content')

    {{-- SECTION 1: HERO Section --}}
    <section class="relative bg-gray-100 w-full pt-14 pb:16 lg:pt-20 lg:pb-22">

        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid gap-8 items-center">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center space-y-6 w-full lg:max-w-[992px] mx-auto">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                        Because Every Student Has Unique Skills — We Help You Discover Them
                    </h1>
                    
                    <p class="text-textBlack text-base md:text-lg leading-tight">
                        Udyantra is a smart, easy-to-use skill assessment platform designed specifically for schools to identify strengths, track progress, and support student growth with data-driven insights.
                    </p>

                    <div class="block md:inline-flex centent-start items-center gap-3">
                        <x-button variant="primary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="#">Request a Demo</x-button>
                        <x-button variant="secondary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="{{ route('register') }}">Start Free Trial</x-button>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: Why Choose Us Section --}}
    <section class="relative w-full pt-14 pb:16 lg:pt-20 lg:pb-22">

        <div class="container mx-auto px-4">

            {{-- Header Section --}}
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-3xl md:text-4xl font-sans font-semibold mb-8 md:mb-10">
                    Why Choose Us
                </h1>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                        
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                    <div class="group relative p-4 grow flex flex-col bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 hover:ring-primary/50 overflow-hidden border-0 text-center">
                        <div class="w-24 h-24 md:w-30 md:h-30 flex items-center justify-center overflow-hidden mx-auto">
                            <img src="{{ asset('assets/image/whychooseus/backed-icon.svg') }}" 
                                alt="Science‐Backed & Psychologist‐Designed Assessments" 
                                class="w-full h-full object-cover">
                        </div>
                        <h5 class="text-base py-3 md:py-3 font-semibold text-black"> Science‐Backed & Psychologist‐Designed Assessments</h5>
                    </div>
                </div>
                                
            </div>
        </div>

    </section>

{{-- SECTION : Success Stories --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-lightgray font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-4">

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
    <section class="font-sans relative z-0 pt-56 md:pt-70 lg:pt-68 pb-16 lg:py-22">
        <x-faq />
    </section>

    {{-- SECTION : Sign Up Today --}}
    
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-gray-100 font-sans relative">
        <x-register />
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