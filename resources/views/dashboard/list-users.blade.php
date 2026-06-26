@extends('layouts.dashboard')

@section('title', $title)

@section('content')

    <div class="max-w-6xl mx-auto">
        
        {{-- HEADER SECTION --}}
        <div class="flex flex-col md:flex-row md:items-center justify-between mb-6 gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-900">{{ $title }}</h1>
                <p class="text-gray-600 mt-1">Total Registered: {{ $users->total() }}</p>
            </div>
            
            <div class="flex flex-col sm:flex-row gap-3">
                {{-- NEW: Search & Source Form --}}
                <form method="GET" action="{{ url()->current() }}" class="flex flex-col sm:flex-row gap-2 items-stretch sm:items-center">
                    <div class="relative w-full sm:w-64">
                        <input 
                            type="text" 
                            name="search" 
                            value="{{ request('search') }}" 
                            placeholder="Search name or email..." 
                            class="pl-10 pr-10 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500 w-full"
                        >
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <x-lucide-search class="w-5 h-5" /> 
                        </div>
                        
                        {{-- "Clear" button shows only if searching --}}
                        @if(request('search'))
                            <a href="{{ url()->current() . (request('form_tag') ? '?form_tag='.request('form_tag') : '') }}" class="absolute right-10 top-2.5 text-gray-400 hover:text-red-500">
                                <x-lucide-x class="w-5 h-5" />
                            </a>
                        @endif
                    </div>

                    <div>
                        <select name="form_tag" onchange="this.form.submit()" class="border border-gray-300 rounded-lg px-3 py-2 text-sm text-textBlack focus:ring-blue-500 focus:border-blue-500 bg-white w-full">
                            <option value="">Form Tag</option>
                            {{-- Dynamic unique form_tags from database --}}
                            @if(isset($form_tags))
                                @foreach($form_tags as $tag)
                                        <option value="{{ $tag }}" {{ request('form_tag') == $tag ? 'selected' : '' }}>
                                            {{ ucfirst($tag) }}
                                        </option>
                                @endforeach
                            @endif
                            
                        </select>
                    </div>
                </form>

                <a href="{{ route('dashboard.add-user') }}" class="bg-primary text-white px-4 py-2 rounded-lg font-semibold hover:bg-primary-dark/80 cursor-pointer transition flex items-center justify-center gap-2 whitespace-nowrap">
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
                                        <span class="text-center text-xs font-bold">
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
                                <td class='px-6 py-4 text-right'>
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('user-notes', ['id' => encrypt($user['id'])]) }}" 
                                           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-primary text-primary font-semibold rounded-xl hover:bg-primary hover:text-white transition-all duration-300 shadow-sm hover:shadow-md group">
                                           <x-lucide-sticky-note class="w-4 h-4 group-hover:rotate-12 transition-transform" />
                                           Notes
                                        </a>
                                        <a href="{{ route('user-test-dashboard', ['id' => encrypt($user['id'])]) }}" 
                                           class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-white border border-primary text-primary font-semibold rounded-xl hover:bg-primary hover:text-white transition-all duration-300 shadow-sm hover:shadow-md group">
                                           <x-lucide-bar-chart-3 class="w-4 h-4 group-hover:rotate-12 transition-transform" />
                                           View Results
                                        </a>
                                    </div>
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