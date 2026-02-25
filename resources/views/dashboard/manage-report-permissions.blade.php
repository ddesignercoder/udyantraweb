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
        <p class="mt-4 text-gray-600">Loading...</p>
    </div>

    <!-- Main Content -->
    <div x-show="!loading" class="space-y-6">

        <!-- Step 1: Select Package -->
        <div class="bg-white rounded-lg shadow-md p-6">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="bg-teal-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">1</span>
                Select a Package
            </h2>

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Choose Package:</label>
                <select @change="selectPackage($event.target.value)" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                >
                    <option value="">-- Select a package --</option>
                    <template x-for="pkg in packages" :key="pkg.id">
                        <option 
                            :value="pkg.id" 
                            x-text="`${pkg.package_name} - ${pkg.category}`"
                        ></option>
                    </template>
                </select>
            </div>

            <!-- Package Details -->
            <div x-show="selectedPackage" class="bg-linear-to-r from-teal-50 to-cyan-50 p-4 rounded-lg border border-teal-200">
                <h3 class="font-semibold text-teal-900 mb-3">📦 Package Details:</h3>
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
                    <div>
                        <span class="text-gray-600">Package:</span>
                        <p class="font-semibold text-gray-900" x-text="selectedPackage?.package_name"></p>
                    </div>
                    <div>
                        <span class="text-gray-600">Category:</span>
                        <p class="font-semibold text-gray-900" x-text="selectedPackage?.category"></p>
                    </div>
                    <div>
                        <span class="text-gray-600">Test:</span>
                        <p class="font-semibold text-gray-900" x-text="selectedPackage?.test_slugs[0]?.name"></p>
                    </div>
                    <div>
                        <span class="text-gray-600">Expiry:</span>
                        <p class="font-semibold text-gray-900" x-text="selectedPackage?.expiry_date"></p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Step 2: Users & Permissions -->
        <div class="bg-white rounded-lg shadow-md p-6" x-show="selectedPackage">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="bg-teal-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">2</span>
                Report Permissions for {{ $role === 'school_admin' ? 'Students' : 'Employees' }}
            </h2>

            <!-- Loading users -->
            <div x-show="loadingUsers" class="text-center py-8">
                <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-teal-600"></div>
                <p class="mt-3 text-gray-600 text-sm">Loading users...</p>
            </div>

            <div x-show="!loadingUsers">
                <!-- Search -->
                <div class="mb-4">
                    <input 
                        type="text" 
                        x-model="searchQuery"
                        placeholder="Search by name or email..."
                        class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                    >
                </div>

                <!-- Stats -->
                <div class="grid grid-cols-3 gap-3 mb-4">
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-blue-700" x-text="users.length"></p>
                        <p class="text-xs text-blue-600">Assigned Users</p>
                    </div>
                    <div class="bg-green-50 border border-green-200 rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-green-700" x-text="totalAllowed"></p>
                        <p class="text-xs text-green-600">Reports Allowed</p>
                    </div>
                    <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-center">
                        <p class="text-lg font-bold text-red-700" x-text="totalRestricted"></p>
                        <p class="text-xs text-red-600">Reports Restricted</p>
                    </div>
                </div>

                <!-- Users List -->
                <div class="space-y-3 max-h-[500px] overflow-y-auto">
                    <template x-for="user in filteredUsers" :key="user.id">
                        <div class="border border-gray-200 rounded-lg overflow-hidden">
                            <!-- User Row -->
                            <div class="px-4 py-3 bg-gray-50 flex items-center justify-between cursor-pointer"
                                 @click="user._expanded = !user._expanded">
                                <div class="flex items-center gap-3">
                                    <div class="w-9 h-9 rounded-full bg-teal-100 flex items-center justify-center">
                                        <span class="text-teal-700 font-bold text-sm" x-text="user.name.charAt(0).toUpperCase()"></span>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-gray-900 text-sm" x-text="user.name"></h3>
                                        <p class="text-xs text-gray-500" x-text="user.email"></p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-3">
                                    <template x-if="user.test_history.length > 0">
                                        <span class="text-xs text-gray-500" x-text="`${user.test_history.length} test(s) taken`"></span>
                                    </template>
                                    <template x-if="user.test_history.length === 0">
                                        <span class="text-xs text-amber-500">No tests taken yet</span>
                                    </template>
                                    <x-lucide-chevron-down class="w-4 h-4 text-gray-400 transition-transform duration-200" 
                                                           ::class="user._expanded ? 'rotate-180' : ''" />
                                </div>
                            </div>

                            <!-- Expanded: Test History with Toggles -->
                            <div x-show="user._expanded && user.test_history.length > 0" x-collapse>
                                <div class="divide-y divide-gray-100">
                                    <template x-for="test in user.test_history" :key="test.test_result_id">
                                        <div class="px-4 py-3 flex items-center justify-between gap-3">
                                            <div class="flex-1">
                                                <p class="text-sm font-medium text-gray-900" x-text="`Assessment #${test.test_id}`"></p>
                                                <p class="text-xs text-gray-500" x-text="test.date"></p>
                                            </div>

                                            <!-- Toggle -->
                                            <div class="flex items-center gap-2">
                                                <span class="text-xs font-medium hidden sm:inline"
                                                      :class="test.can_view_report ? 'text-green-600' : 'text-red-500'"
                                                      x-text="test.can_view_report ? '📊 Allowed' : '🔒 Restricted'">
                                                </span>
                                                <button 
                                                    @click="togglePermission(test)"
                                                    :disabled="test._toggling || !test.assignment_id"
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

                            <!-- No tests message -->
                            <div x-show="user._expanded && user.test_history.length === 0" x-collapse>
                                <div class="px-4 py-3 text-center">
                                    <p class="text-sm text-gray-400">This user hasn't completed any tests yet</p>
                                </div>
                            </div>
                        </div>
                    </template>

                    <!-- No users found -->
                    <div x-show="filteredUsers.length === 0 && !loadingUsers" class="text-center py-8">
                        <p class="text-gray-500 text-sm">No assigned {{ $role === 'school_admin' ? 'students' : 'employees' }} found for this package</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function reportPermissions() {
    return {
        packages: [],
        users: [],
        selectedPackage: null,
        searchQuery: '',
        loading: true,
        loadingUsers: false,

        async init() {
            await this.loadPackages();
            this.loading = false;
        },

        async loadPackages() {
            try {
                const response = await axios.get('/purchased-packages');
                if (response.data.status) {
                    this.packages = response.data.data;
                }
            } catch (error) {
                console.error('Failed to load packages:', error);
                Toast.fire({ icon: 'error', title: 'Failed to load packages.' });
            }
        },

        async selectPackage(packageId) {
            if (!packageId) {
                this.selectedPackage = null;
                this.users = [];
                return;
            }

            this.selectedPackage = this.packages.find(p => p.id == packageId);
            this.users = [];
            this.searchQuery = '';

            // Load users for this package
            this.loadingUsers = true;
            try {
                const response = await axios.get('/users-with-test-history', {
                    params: { subscription_id: this.selectedPackage.subscription_id }
                });
                if (response.data.status) {
                    this.users = response.data.data.map(user => ({
                        ...user,
                        _expanded: true,
                        test_history: (user.test_history || []).map(test => ({
                            ...test,
                            _toggling: false
                        }))
                    }));
                }
            } catch (error) {
                console.error('Failed to load users:', error);
                Toast.fire({ icon: 'error', title: 'Failed to load users.' });
            } finally {
                this.loadingUsers = false;
            }
        },

        async togglePermission(test) {
            if (!test.assignment_id) {
                Toast.fire({ icon: 'warning', title: 'No assignment found for this test' });
                return;
            }

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
                    Toast.fire({ icon: 'error', title: response.data.message || 'Failed to update' });
                }
            } catch (error) {
                console.error('Toggle failed:', error);
                Toast.fire({ icon: 'error', title: 'Failed to update permission' });
            } finally {
                test._toggling = false;
            }
        },

        get filteredUsers() {
            if (!this.searchQuery) return this.users;
            const query = this.searchQuery.toLowerCase();
            return this.users.filter(user =>
                user.name.toLowerCase().includes(query) ||
                user.email.toLowerCase().includes(query)
            );
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
