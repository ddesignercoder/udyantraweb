@extends('layouts.app')

@section('title', 'Register-Organization')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4" x-data="{ type: 'school' }">
    <div class="max-w-2xl w-full bg-white p-8 rounded-xl shadow-lg">
        
        <h2 class="text-2xl font-bold text-gray-800 mb-4 text-center">Register Organization</h2>


        <form action="{{ route('register.org.submit') }}" method="POST">
            @csrf
            
            <div class="flex bg-gray-100 p-1 rounded-lg mb-4">
                <input type="hidden" name="type" x-model="type">
                
                <button type="button" @click="type = 'school'"
                    :class="type === 'school' ? 'bg-white shadow text-primary' : 'text-black'"
                    class="flex-1 py-2 rounded-md font-semibold transition">
                    School
                </button>
                <button type="button" @click="type = 'company'"
                    :class="type === 'company' ? 'bg-white shadow text-primary' : 'text-black'"
                    class="flex-1 py-2 rounded-md font-semibold transition">
                    Company
                </button>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                
                <div class="col-span-1 md:col-span-2">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">Organization Info</h3>
                </div>

                <div class="col-span-1 md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">
                        <span x-text="type === 'school' ? 'School Name' : 'Company Name'"></span>
                    </label>
                    <input type="text" name="org_name" value="{{ old('org_name') }}" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors"
                        :placeholder="type === 'school' ? 'e.g. St. Xavier\'s High School' : 'e.g. Tech Solutions Pvt Ltd'">
                </div>

                <div class="col-span-1 md:col-span-2 mt-4">
                    <h3 class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-2 border-b pb-1">Admin Login Details</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Your Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" required class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Login Email</label>
                    <input type="email" name="email" value="{{ old('email') }}" required class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" required class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" required class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors">
                </div>

            </div>

            <button type="submit" class="w-full mt-8 bg-primary hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition shadow-lg">
                Create Account
            </button>

            <!-- <div class="text-center mt-4">
                <a href="{{ route('register.select') }}" class="text-sm text-gray-500 hover:text-gray-900">Cancel</a>
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