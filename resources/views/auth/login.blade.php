@extends('layouts.app')

@section('title', 'Login')

@section('content')


<div class="mx-auto px-4 md:px-4 flex items-center justify-center bg-lightgray  py-8">
    <div class="max-w-md w-full space-y-8 bg-white p-6 rounded-2xl shadow-amber-100">
        {{-- Header --}}
        <h1 class="text-3xl text-center font-extrabold text-black mb-0">
            Welcome Back
        </h1>
        <p class="mt-2 text-sm text-center text-textBlack">
            Sign in to manage your assessments
        </p>

        {{-- Login Form --}}
        <form class="mt-8 mb-0 space-y-6" action="{{ route('api.login') }}" method="POST">
            @csrf
            
            <div class="rounded-md  space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-textBlack mb-1">Email address</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="you@example.com">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-textBlack mb-1">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
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
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-primary-dark hover:bg-primary-light focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary shadow-md transition-all hover:-translate-y-0.5 cursor-pointer">
                    Login
                </button>
            </div>
        </form>

        {{-- Register Link --}}
        <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                Don't have an account? 
                <a href="{{ route('register.select') }}" class="font-medium text-primary hover:text-primary transition-colors">
                    Register here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection