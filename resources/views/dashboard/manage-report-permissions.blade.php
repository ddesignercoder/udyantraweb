@extends('layouts.dashboard')

@section('title', 'Manage Report Permissions')

@section('content')
<div class="max-w-7xl mx-auto p-6" x-data="reportPermissions()">
    <!-- Header -->
    <div class="mb-8 flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <div class="flex items-center gap-3 mb-1">
                <div class="p-2 bg-teal-50 text-teal-600 rounded-xl">
                    <x-lucide-shield-check class="w-6 h-6 md:w-8 md:h-8" />
                </div>
                <h1 class="text-2xl md:text-3xl font-extrabold text-gray-900 tracking-tight">
                    Manage Report Permissions
                </h1>
            </div>
            <p class="text-gray-500 text-sm md:text-base ml-1">
                Control which {{ $role === 'school_admin' ? 'students' : 'employees' }} can view their test reports
            </p>
        </div>
        <a href="{{ route('dashboard.manage-tests') }}" 
           class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-white border-2 border-teal-600 text-teal-600 font-bold rounded-xl hover:bg-teal-600 hover:text-white transition-all duration-300 shadow-sm hover:shadow-md group text-sm">
            <x-lucide-clipboard-list class="w-4 h-4 group-hover:rotate-12 transition-transform" />
            Assign Tests
        </a>
    </div>

    <!-- Loading State -->
    <div x-show="loading" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-teal-600"></div>
        <p class="mt-4 text-gray-600">Loading users and test data...</p>
    </div>

    <!-- Main Content -->
    <div x-show="!loading">
        <!-- Search & Filters -->
        <div class="mb-6">
            <div class="flex flex-col sm:flex-row gap-4">
                <div class="flex-1">
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Search by name or email..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    >
                </div>
                <select x-model="filterStatus" 
                        class="border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500">
                    <option value="all">All Permissions</option>
                    <option value="allowed">Report Allowed</option>
                    <option value="restricted">Report Restricted</option>
                </select>
            </div>
        </div>

        <!-- Stats Summary -->
        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <x-lucide-users class="w-5 h-5 text-blue-600" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Total Users with Tests</p>
                        <p class="text-xl font-bold text-gray-900" x-text="users.length"></p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-green-50 rounded-lg">
                        <x-lucide-eye class="w-5 h-5 text-green-600" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Reports Allowed</p>
                        <p class="text-xl font-bold text-green-600" x-text="totalAllowed"></p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-red-50 rounded-lg">
                        <x-lucide-eye-off class="w-5 h-5 text-red-600" />
                    </div>
                    <div>
                        <p class="text-sm text-gray-500">Reports Restricted</p>
                        <p class="text-xl font-bold text-red-600" x-text="totalRestricted"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users List -->
        <div class="space-y-4">
            <template x-for="user in filteredUsers" :key="user.id">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <!-- User Header -->
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between cursor-pointer"
                         @click="user._expanded = !user._expanded">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-teal-100 flex items-center justify-center">
                                <span class="text-teal-700 font-bold text-sm" x-text="user.name.charAt(0).toUpperCase()"></span>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-900" x-text="user.name"></h3>
                                <p class="text-sm text-gray-500" x-text="user.email"></p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500" x-text="`${user.test_history.length} test(s)`"></span>
                            <x-lucide-chevron-down class="w-5 h-5 text-gray-400 transition-transform duration-200" 
                                                   ::class="user._expanded ? 'rotate-180' : ''" />
                        </div>
                    </div>

                    <!-- Test History (Expandable) -->
                    <div x-show="user._expanded" x-collapse>
                        <div class="divide-y divide-gray-100">
                            <template x-for="test in user.test_history" :key="test.test_result_id">
                                <div class="px-6 py-4 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2">
                                            <p class="font-medium text-gray-900" x-text="`Assessment #${test.test_id}`"></p>
                                            <span class="px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                Completed
                                            </span>
                                        </div>
                                        <p class="text-sm text-gray-500 mt-1" x-text="test.date"></p>
                                    </div>

                                    <!-- Toggle Switch -->
                                    <div class="flex items-center gap-3">
                                        <span class="text-sm font-medium"
                                              :class="test.can_view_report ? 'text-green-600' : 'text-red-500'"
                                              x-text="test.can_view_report ? '📊 Report Allowed' : '🔒 Report Restricted'">
                                        </span>
                                        <button 
                                            @click="togglePermission(test)"
                                            :disabled="test._toggling"
                                            class="relative inline-flex h-6 w-11 items-center rounded-full transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-teal-500 focus:ring-offset-2 disabled:opacity-50"
                                            :class="test.can_view_report ? 'bg-green-500' : 'bg-gray-300'">
                                            <span class="inline-block h-4 w-4 transform rounded-full bg-white transition-transform duration-200 shadow-sm"
                                                  :class="test.can_view_report ? 'translate-x-6' : 'translate-x-1'">
                                            </span>
                                        </button>
                                    </div>
                                </div>
                            </template>
                        </div>
                    </div>
                </div>
            </template>

            <!-- No Users Found -->
            <div x-show="filteredUsers.length === 0 && !loading" class="bg-white rounded-lg shadow-sm border border-gray-200 p-12 text-center">
                <div class="mx-auto w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <x-lucide-search-x class="w-8 h-8 text-gray-400" />
                </div>
                <h3 class="text-lg font-bold text-gray-900 mb-1">No matching users found</h3>
                <p class="text-gray-500 text-sm">Try adjusting your search or filter criteria</p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function reportPermissions() {
    return {
        users: [],
        searchQuery: '',
        filterStatus: 'all',
        loading: true,

        async init() {
            await this.loadData();
            this.loading = false;
        },

        async loadData() {
            try {
                const response = await axios.get('/users-with-test-history');
                if (response.data.status) {
                    this.users = response.data.data.map(user => ({
                        ...user,
                        _expanded: true,
                        test_history: user.test_history.map(test => ({
                            ...test,
                            _toggling: false
                        }))
                    }));
                }
            } catch (error) {
                console.error('Failed to load data:', error);
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to load data. Please refresh the page.'
                });
            }
        },

        async togglePermission(test) {
            test._toggling = true;
            const newValue = !test.can_view_report;

            try {
                const response = await axios.patch('/toggle-report-permission', {
                    assignment_id: test.assignment_id,
                    can_view_report: newValue
                });

                if (response.data.status) {
                    test.can_view_report = newValue;
                    Toast.fire({
                        icon: 'success',
                        title: newValue ? 'Report access granted' : 'Report access restricted'
                    });
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.data.message || 'Failed to update permission'
                    });
                }
            } catch (error) {
                console.error('Toggle failed:', error);
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to update permission'
                });
            } finally {
                test._toggling = false;
            }
        },

        get filteredUsers() {
            let result = this.users;

            if (this.searchQuery) {
                const query = this.searchQuery.toLowerCase();
                result = result.filter(user =>
                    user.name.toLowerCase().includes(query) ||
                    user.email.toLowerCase().includes(query)
                );
            }

            if (this.filterStatus !== 'all') {
                result = result.filter(user => {
                    return user.test_history.some(test => {
                        if (this.filterStatus === 'allowed') return test.can_view_report;
                        if (this.filterStatus === 'restricted') return !test.can_view_report;
                        return true;
                    });
                });
            }

            return result;
        },

        get totalAllowed() {
            return this.users.reduce((count, user) => {
                return count + user.test_history.filter(t => t.can_view_report).length;
            }, 0);
        },

        get totalRestricted() {
            return this.users.reduce((count, user) => {
                return count + user.test_history.filter(t => !t.can_view_report).length;
            }, 0);
        }
    }
}
</script>
@endsection

@section('css')
<style>
[x-cloak] { display: none !important; }
</style>
@endsection
