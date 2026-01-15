@extends('layouts.dashboard')

@section('title', $role === 'school_admin' ? 'Add New Student' : 'Add New Employee')

@section('content')

    <div class="max-w-4xl mx-auto">
        
        <div class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">
                    {{ $role === 'school_admin' ? 'Register New Student' : 'Register New Employee' }}
                </h1>
                <p class="text-gray-600 mt-1">Create a new ID for your organization.</p>
            </div>
            <a href="{{ route('user.dashboard') }}" class="text-sm text-blue-600 hover:underline">
                &larr; Back to Dashboard
            </a>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('org.add.user') }}" method="POST" class="p-6 md:p-8">
                @csrf

                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">Login Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" required class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2.5">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Default Password</label>
                        <input type="text" name="password" value="Password@123" required class="w-full bg-gray-50 border-gray-300 rounded-lg shadow-sm text-gray-500 border p-2.5">
                        <p class="text-xs text-gray-500 mt-1">You can change this default password.</p>
                    </div>
                </div>

                <h3 class="text-lg font-semibold text-gray-800 mb-4 border-b pb-2">
                    {{ $role === 'school_admin' ? 'Student Profile' : 'Employee Profile' }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                    
                    @if($role === 'school_admin')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Roll Number</label>
                            <input type="text" name="roll_no" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Class / Grade</label>
                            <input type="text" name="class" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                            <input type="text" name="section" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Name</label>
                            <input type="text" name="guardian_name" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                    @endif

                    @if($role === 'company_admin')
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                            <input type="text" name="employee_code" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                            <input type="text" name="designation" required class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                    @endif

                </div>

                <div class="flex items-center justify-end gap-4 bg-gray-50 -mx-8 -mb-8 p-6 mt-4 border-t border-gray-200">
                    <a href="{{ route('user.dashboard') }}" class="text-gray-600 hover:text-gray-900 font-medium">Cancel</a>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2.5 rounded-lg font-semibold shadow hover:bg-blue-700 transition">
                        Create {{ $role === 'school_admin' ? 'Student' : 'Employee' }} ID
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection