@extends('layouts.dashboard')

@section('title', $title)

@section('content')

    <div class="max-w-6xl mx-auto">
        
        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                {{-- UPDATED: Use ->total() for the grand total from API --}}
                <p class="text-gray-600 mt-1">Total Registered: {{ $users->total() }}</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                {{-- NEW: Search Form --}}
                <form method="GET" action="{{ url()->current() }}" class="relative">
                    <input 
                        type="text" 
                        name="search" 
                        value="{{ request('search') }}" 
                        placeholder="Search name or email..." 
                        class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full sm:w-64"
                    >
                    <div class="absolute left-3 top-2.5 text-gray-400">
                        {{-- Assuming you have lucide icons, otherwise use SVG --}}
                        <x-lucide-search class="w-5 h-5" /> 
                    </div>
                    
                    {{-- "Clear" button shows only if searching --}}
                    @if(request('search'))
                        <a href="{{ url()->current() }}" class="absolute right-3 top-2.5 text-gray-400 hover:text-red-500">
                            <x-lucide-x class="w-5 h-5" />
                        </a>
                    @endif
                </form>

                <a href="{{ route('dashboard.add-user') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center gap-2 whitespace-nowrap">
                    <x-lucide-plus class="w-5 h-5" />
                    Add New {{ $role === 'school_admin' ? 'Student' : 'Employee' }}
                </a>
            </div>
        </div>

        {{-- TABLE SECTION --}}
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden flex flex-col">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm text-gray-600">
                    <thead class="bg-gray-50 text-gray-900 uppercase font-semibold text-xs border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4">Name</th>
                            <th class="px-6 py-4">Email</th>
                            
                            @if($role === 'school_admin')
                                <th class="px-6 py-4">Roll No</th>
                                <th class="px-6 py-4">Class</th>
                            @else
                                <th class="px-6 py-4">Emp Code</th>
                                <th class="px-6 py-4">Designation</th>
                            @endif

                            <th class="px-6 py-4">Registered On</th>
                            <th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4 font-medium text-gray-900">
                                    {{ $user['name'] }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $user['email'] }}
                                </td>

                                {{-- Dynamic Columns based on Role --}}
                                @if($role === 'school_admin')
                                    <td class="px-6 py-4">
                                        <span class="bg-blue-50 text-blue-700 px-2 py-1 rounded text-xs font-bold">
                                            {{ $user['student_profile']['roll_no'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user['student_profile']['class'] ?? '-' }} 
                                        {{ $user['student_profile']['section'] ? '('.$user['student_profile']['section'].')' : '' }}
                                    </td>
                                @else
                                    <td class="px-6 py-4">
                                        <span class="bg-indigo-50 text-indigo-700 px-2 py-1 rounded text-xs font-bold">
                                            {{ $user['employee_profile']['employee_code'] ?? 'N/A' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">
                                        {{ $user['employee_profile']['designation'] ?? '-' }}
                                    </td>
                                @endif

                                <td class="px-6 py-4">
                                    {{ \Carbon\Carbon::parse($user['created_at'])->format('d M, Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <button class="text-blue-600 hover:text-blue-800 font-medium text-xs">Edit</button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center justify-center">
                                        <x-lucide-users class="w-10 h-10 text-gray-300 mb-2" />
                                        <p>No records found.</p>
                                        @if(request('search'))
                                            <p class="text-xs mt-1">Try adjusting your search criteria.</p>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- NEW: FOOTER / PAGINATION SECTION --}}
            @if($users->hasPages())
                <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
                    {{-- 
                        withQueryString() is crucial! 
                        It ensures that if you are on ?search=rohit, page 2 becomes ?search=rohit&page=2 
                    --}}
                    {{ $users->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>

@endsection