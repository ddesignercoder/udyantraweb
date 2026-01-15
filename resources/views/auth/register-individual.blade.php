@extends('layouts.app')

@section('title', 'Register as Individual')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
        
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Create Account
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                Register as an Individual / Student
            </p>
        </div>

        <form class="mt-8 space-y-6" action="{{ route('register.ind.submit') }}" method="POST">
            @csrf
            
            <div class="rounded-2xl shadow-sm space-y-4 p-2">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="John Doe">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="john@example.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="••••••••">
                </div>
            </div>

            <!-- <div>
                <button type="submit" class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    Sign Up
                </button>
            </div> -->
            <div>
                <button type="submit" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition cursor-pointer">
                    Create Account
                </button>
            </div>

            <!-- <div class="flex items-center justify-between text-sm">
                <a href="{{ route('register.select') }}" class="font-medium text-blue-600 hover:text-blue-500">
                    &larr; Back to Selection
                </a>
                <a href="{{ route('login') }}" class="font-medium text-gray-600 hover:text-gray-900">
                    Already have an account? Login
                </a>
            </div> -->

        </form>
        <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                Already have an account? 
                <a href="{{ route('login') }}" class="font-medium text-primary hover:text-primary-dark transition-colors">
                    Login here
                </a>
            </p>
        </div>
    </div>
</div>
@endsection