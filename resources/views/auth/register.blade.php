@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="min-h-[80vh] flex items-center justify-center bg-[var(--color-input-bg)]">
    <div class="max-w-md w-full space-y-8 bg-white p-4 md:p-8 rounded-[var(--radius-card)] shadow-[var(--shadow-card)]">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-[var(--color-navy)]">
                Create Account
            </h2>
            <p class="mt-2 text-sm text-[var(--color-navy-light)]">
                Join Udyantra and start creating
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('api.register') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-[var(--color-navy)] mb-1">Full Name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="appearance-none block w-full px-4 py-3 border border-[var(--color-input-border)] placeholder-gray-400 text-[var(--color-navy)] rounded-[var(--radius-btn)] focus:outline-none focus:ring-2 focus:ring-[var(--color-cyan)] focus:border-transparent sm:text-sm bg-[var(--color-input-bg)]" 
                        placeholder="John Doe">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-[var(--color-navy)] mb-1">Email address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="appearance-none block w-full px-4 py-3 border border-[var(--color-input-border)] placeholder-gray-400 text-[var(--color-navy)] rounded-[var(--radius-btn)] focus:outline-none focus:ring-2 focus:ring-[var(--color-cyan)] focus:border-transparent sm:text-sm bg-[var(--color-input-bg)]" 
                        placeholder="you@example.com">
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-[var(--color-navy)] mb-1">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none block w-full px-4 py-3 border border-[var(--color-input-border)] placeholder-gray-400 text-[var(--color-navy)] rounded-[var(--radius-btn)] focus:outline-none focus:ring-2 focus:ring-[var(--color-cyan)] focus:border-transparent sm:text-sm bg-[var(--color-input-bg)]" 
                        placeholder="Create a strong password">
                    <p class="mt-1 text-xs text-[var(--color-navy-light)]">Must be at least 8 characters.</p>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-[var(--radius-btn)] text-white bg-[var(--color-cyan)] hover:bg-[var(--color-cyan-hover)] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[var(--color-cyan)] shadow-md transition-all hover:-translate-y-0.5">
                    Create Account
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-[var(--color-navy-light)]">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-[var(--color-cyan)] hover:text-[var(--color-cyan-hover)] transition-colors">
                    Login here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection