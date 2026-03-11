@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<div class="mx-auto px-4 md:px-4 flex items-center justify-center bg-lightgray py-8">
    <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-2xl shadow-amber-100">

        {{-- Header --}}
        <h1 class="text-3xl text-center font-extrabold text-black mb-0">
            Set New Password
        </h1>
        <p class="mt-2 text-sm text-center text-textBlack">
            Create a strong new password for your account.
        </p>

        {{-- Success Message --}}
        <div id="success-msg" class="hidden bg-green-50 border border-green-300 text-green-700 text-sm rounded-lg p-4 text-center">
            ✅ Password reset successful! Redirecting to login…
        </div>

        {{-- Error Message --}}
        <div id="error-msg" class="hidden bg-red-50 border border-red-300 text-red-700 text-sm rounded-lg p-4 text-center"></div>

        {{-- Invalid Link Banner --}}
        <div id="invalid-link-msg" class="hidden bg-yellow-50 border border-yellow-300 text-yellow-800 text-sm rounded-lg p-4 text-center">
            ⚠️ This reset link is invalid or has expired.
            <a href="{{ route('password.request') }}" class="font-medium underline">Request a new one</a>.
        </div>

        {{-- Reset Form --}}
        <form id="reset-password-form" class="mt-4 mb-0 space-y-6">
            <div>
                <label for="password" class="block text-sm font-medium text-textBlack mb-1">New Password</label>
                <input id="password" name="password" type="password" required minlength="8"
                    class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors"
                    placeholder="Minimum 8 characters">
            </div>

            <div>
                <label for="password_confirmation" class="block text-sm font-medium text-textBlack mb-1">Confirm New Password</label>
                <input id="password_confirmation" name="password_confirmation" type="password" required minlength="8"
                    class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors"
                    placeholder="Re-enter your new password">
            </div>

            <div>
                <button type="submit" id="submit-btn"
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-primary-dark hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md transition-all hover:-translate-y-0.5 cursor-pointer disabled:opacity-60 disabled:cursor-not-allowed">
                    <span id="btn-text">Reset Password</span>
                    <span id="btn-loading" class="hidden">Resetting…</span>
                </button>
            </div>
        </form>

        {{-- Back to Login --}}
        <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary transition-colors">
                    Back to Login
                </a>
            </p>
        </div>
    </div>
</div>

<script>
    const params = new URLSearchParams(window.location.search);
    const token  = params.get('token');
    const email  = params.get('email');

    const form         = document.getElementById('reset-password-form');
    const invalidBlock = document.getElementById('invalid-link-msg');

    // Guard: if no token or email in URL, show invalid link message immediately
    if (!token || !email) {
        form.classList.add('hidden');
        invalidBlock.classList.remove('hidden');
    }

    form.addEventListener('submit', async function (e) {
        e.preventDefault();

        const password              = document.getElementById('password').value;
        const password_confirmation = document.getElementById('password_confirmation').value;
        const submitBtn             = document.getElementById('submit-btn');
        const btnText               = document.getElementById('btn-text');
        const btnLoad               = document.getElementById('btn-loading');
        const successEl             = document.getElementById('success-msg');
        const errorEl               = document.getElementById('error-msg');

        if (password !== password_confirmation) {
            errorEl.textContent = 'Passwords do not match.';
            errorEl.classList.remove('hidden');
            return;
        }

        errorEl.classList.add('hidden');
        submitBtn.disabled = true;
        btnText.classList.add('hidden');
        btnLoad.classList.remove('hidden');

        try {
            const response = await fetch("{{ route('password.reset.submit') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({ email, token, password, password_confirmation }),
            });

            const data = await response.json();

            if (response.ok && data.status) {
                form.classList.add('hidden');
                successEl.classList.remove('hidden');
                // Redirect to login after 2 seconds
                setTimeout(() => { window.location.href = "{{ route('login') }}"; }, 2000);
            } else {
                errorEl.textContent = data.message || 'Something went wrong. Please try again.';
                errorEl.classList.remove('hidden');
                submitBtn.disabled = false;
                btnText.classList.remove('hidden');
                btnLoad.classList.add('hidden');
            }
        } catch (err) {
            errorEl.textContent = 'Network error. Please check your connection and try again.';
            errorEl.classList.remove('hidden');
            submitBtn.disabled = false;
            btnText.classList.remove('hidden');
            btnLoad.classList.add('hidden');
        }
    });
</script>

@endsection
