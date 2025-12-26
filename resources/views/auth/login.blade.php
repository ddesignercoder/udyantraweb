@extends('layouts.app')

@section('title', 'Login')

@section('content')


<div class="min-h-[80vh] flex items-center justify-center bg-lightgray">
    <div class="max-w-md w-full space-y-8 bg-white p-4 md:p-8 rounded-2xl shadow-amber-100">
       
        
        {{-- Header --}}
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-black">
                Welcome Back
            </h2>
            <p class="mt-2 text-sm text-textBlack">
                Sign in to manage your assessments
            </p>
        </div>

        {{-- Login Form --}}
        <form class="mt-8 space-y-6" action="{{ route('api.login') }}" method="POST">
            @csrf
            
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-textBlack mb-1">Email address</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="you@example.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text- mb-1">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text- rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="••••••••">
                </div>
            </div>

            <div class="flex items-center justify-between">
                <div class="flex items-center">
                    <input id="remember-me" name="remember-me" type="checkbox" class="h-4 w-4 text-black focus:ring-primary border-gray-300 rounded">
                    <label for="remember-me" class="ml-2 block text-sm text-textBlack">
                        Remember me
                    </label>
                </div>

                <div class="text-sm">
                    <a href="#" class="font-medium text-textBlack hover:text-primary">
                        Forgot password?
                    </a>
                </div>
            </div>

            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-2xl text-white bg-primary-dark hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
                    Sign in
                </button>
            </div>
        </form>

        {{-- Register Link --}}
        <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                Don't have an account? 
                <a href="{{ route('register') }}" class="font-medium text-primary hover:text-primary transition-colors">
                    Register here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection