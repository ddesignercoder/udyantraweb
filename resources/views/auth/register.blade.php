@extends('layouts.app')

@section('title', 'Register')

@section('content')

<div class="min-h-[80vh] flex items-center justify-center bg-lightgray">
    <div class="max-w-md w-full space-y-8 bg-white p-4 md:p-8 rounded-2xl shadow-amber-100">
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-black">
                Create Account
            </h2>
            <p class="mt-2 text-sm text-textBlack">
                Join Udyantra and start your journey
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('api.register') }}" method="POST">
            @csrf
            
            <div class="space-y-4">
                {{-- Name --}}
                <div>
                    <label for="name" class="block text-sm font-medium text-textBlack mb-1">Full Name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="appearance-none block w-full px-4 py-3 border border-primary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary-dark focus:border-transparent sm:text-sm bg-lightgray" 
                        placeholder="John Doe">
                </div>

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-sm font-medium text-textBlack mb-1">Email address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="appearance-none block w-full px-4 py-3 border border-primary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary-dark focus:border-transparent sm:text-sm bg-lightgray" 
                        placeholder="you@example.com">
                </div>

                {{-- Password --}}
                <div>
                    <label for="password" class="block text-sm font-medium text-textBlack mb-1">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none block w-full px-4 py-3 border border-primary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary-dark focus:border-transparent sm:text-sm bg-lightgray" 
                        placeholder="Create a strong password">
                    <p class="mt-1 text-xs text-textBlack">Must be at least 8 characters.</p>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
                    Create Account
                </button>
            </div>
        </form>

        <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">
                    LogIn here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection