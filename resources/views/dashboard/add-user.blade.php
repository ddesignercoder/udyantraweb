@extends('layouts.dashboard')

@section('title', $role === 'school_admin' ? 'Add New Student' : 'Add New Employee')

@section('content')

    <div class="max-w-5xl mx-auto px-4 sm:px-6">
        
        <div class="mb-6 md:mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                    {{ $role === 'school_admin' ? 'Register New Student' : 'Register New Employee' }}
                </h1>
                <p class="text-sm md:text-base text-gray-600 mt-1">Create a new ID for your organization.</p>
            </div>
            <div>
                <a href="{{ route('dashboard.bulk-upload-users') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-2 bg-primary hover:bg-white hover:text-primary border border-primary text-white px-4 py-2.5 rounded-lg font-medium text-sm shadow transition cursor-pointer">
                    <x-lucide-upload class="w-4 h-4" />
                    Bulk Upload
                </a>
            </div>
        </div>
        
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
            <form action="{{ route('org.add.user') }}" method="POST" class="p-6 md:p-8">
                @csrf

                <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4 border-b pb-2">Login Details</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                        <input type="text" name="name" required placeholder="Enter full name" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2.5">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email Address</label>
                        <input type="email" name="email" required placeholder="example@email.com" class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 border p-2.5">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Default Password</label>
                        <input type="text" name="password" value="Password@123" required class="w-full bg-gray-50 border-gray-300 rounded-lg shadow-sm text-gray-500 border p-2.5">
                        <p class="text-xs text-gray-500 mt-1">You can change this default password.</p>
                    </div>
                </div>

                <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4 border-b pb-2">
                    {{ $role === 'school_admin' ? 'Student Profile' : 'Employee Profile' }}
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-6 md:mb-8">
                    
                    @if($role === 'school_admin')
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Roll Number</label>
                            <input type="text" name="roll_no" required placeholder="e.g. 2024001" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Class / Grade</label>
                            <input type="text" name="class" required placeholder="e.g. 10" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Section</label>
                            <input type="text" name="section" placeholder="e.g. A" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Guardian Name</label>
                            <input type="text" name="guardian_name" required placeholder="Enter guardian's name" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                    @endif

                    @if($role === 'company_admin')
                         <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Employee ID</label>
                            <input type="text" name="employee_code" required placeholder="e.g. EMP001" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Designation</label>
                            <input type="text" name="designation" required placeholder="e.g. Software Engineer" class="w-full border-gray-300 rounded-lg shadow-sm border p-2.5">
                        </div>
                    @endif

                </div>

                <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 sm:gap-4 bg-gray-50 -mx-6 md:-mx-8 -mb-6 md:-mb-8 p-4 md:p-6 mt-4 border-t border-gray-200">
                    <a href="{{ route('user.dashboard') }}" class="w-full sm:w-auto text-center text-gray-600 hover:text-gray-900 font-medium py-2.5">Cancel</a>
                    <button type="submit" class="w-full sm:w-auto bg-primary hover:bg-white hover:text-primary border border-primary text-white px-6 py-2.5 rounded-lg font-semibold shadow transition cursor-pointer flex items-center justify-center gap-2">
                        <x-lucide-user-plus class="w-5 h-5" />
                        Create {{ $role === 'school_admin' ? 'Student' : 'Employee' }} 
                    </button>
                </div>

            </form>
        </div>
    </div>

@endsection