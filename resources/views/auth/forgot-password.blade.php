@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')

<div class="mx-auto px-4 md:px-4 flex items-center justify-center bg-lightgray py-8">
    <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-2xl shadow-amber-100">

        {{-- Header --}}
        <h1 class="text-3xl text-center font-extrabold text-black mb-0">
            Forgot Password?
        </h1>
        <p class="mt-2 text-sm text-center text-textBlack">
            Enter your registered email and we will send you a reset link.
        </p>

        {{-- Success Message (hidden by default) --}}
        <div id="success-msg" class="hidden bg-green-50 border border-green-300 text-green-700 text-sm rounded-lg p-4 text-center">
            ✅ If your email is registered, you will receive a password reset link shortly. Please check your inbox (and spam folder).
        </div>

        {{-- Error Message (hidden by default) --}}
        <div id="error-msg" class="hidden bg-red-50 border border-red-300 text-red-700 text-sm rounded-lg p-4 text-center"></div>

        {{-- Form --}}
        <form id="forgot-password-form" class="mt-4 mb-0 space-y-6">
            <div>
                <label for="email" class="block text-sm font-medium text-textBlack mb-1">Email address</label>
                <input id="email" name="email" type="email" required
                    class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors"
                    placeholder="you@example.com">
            </div>

            <div>
                <button type="submit" id="submit-btn"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-primary-dark hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md transition-all hover:-translate-y-0.5 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                    <span id="btn-text">Send Reset Link</span>
                    <span id="btn-loading" class="hidden">Sending…</span>
                </button>
            </div>
        </form>

        {{-- Back to Login --}}
        <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                Remembered it?
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary transition-colors">
                    Back to Login
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    const apiBase = "{{ rtrim(config('services.backend.url', ''), '/') }}";

    document.getElementById('forgot-password-form').addEventListener('submit', async function (e) {
        e.preventDefault();

        const email     = document.getElementById('email').value.trim();
        const submitBtn = document.getElementById('submit-btn');
        const btnText   = document.getElementById('btn-text');
        const btnLoad   = document.getElementById('btn-loading');
        const successEl = document.getElementById('success-msg');
        const errorEl   = document.getElementById('error-msg');

        // Reset UI
        successEl.classList.add('hidden');
        errorEl.classList.add('hidden');
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoad.classList.remove('hidden');

        try {
            const response = await fetch(`${apiBase}/api/forgot-password`, {
                method: 'POST',
                headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
                body: JSON.stringify({ email }),
            });

            const data = await response.json();

            if (response.ok && data.status) {
                // Success — hide form and show confirmation
                document.getElementById('forgot-password-form').classList.add('hidden');
                successEl.classList.remove('hidden');
            } else {
                errorEl.textContent = data.message || 'Something went wrong. Please try again.';
                errorEl.classList.remove('hidden');
            }
        } catch (err) {
            errorEl.textContent = 'Network error. Please check your connection and try again.';
            errorEl.classList.remove('hidden');
        } finally {
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoad.classList.add('hidden');
        }
    });
</script>

@endsection
