@extends('layouts.dashboard')

@section('title', 'Manage Tests')


@section('content')
<div class="max-w-7xl mx-auto p-6" x-data="manageTests()">
    <!-- Header -->
    <div class="mb-8">
        <h1 class="text-3xl font-bold text-gray-900">Assign Tests to {{ $role === 'school_admin' ? 'Students' : 'Employees' }}</h1>
        <p class="text-gray-600 mt-2">Select a package and assign tests to your {{ $role === 'school_admin' ? 'students' : 'employees' }}</p>
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
                <select 
                    @change="selectPackage($event.target.value)" 
                    class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                >
                    <option value="">-- Select a package --</option>
                    <template x-for="pkg in packages" :key="pkg.id">
                        <option 
                            :value="pkg.id" 
                            x-text="`${pkg.package_name} - ${pkg.category} (${pkg.remaining_assignments}/${pkg.total_assignments} remaining)`"
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
                        <span class="text-gray-600">Available:</span>
                        <p class="font-semibold text-teal-600" x-text="`${selectedPackage?.remaining_assignments} assignments`"></p>
                    </div>
                </div>
                <div class="mt-3 text-xs text-gray-500">
                    <p>Expiry: <span x-text="selectedPackage?.expiry_date"></span></p>
                </div>
            </div>
        </div>

        <!-- Step 2: Select Users -->
        <div class="bg-white rounded-lg shadow-md p-6" x-show="selectedPackage">
            <h2 class="text-xl font-semibold mb-4 flex items-center">
                <span class="bg-teal-600 text-white rounded-full w-8 h-8 flex items-center justify-center mr-3">2</span>
                Select {{ $role === 'school_admin' ? 'Students' : 'Employees' }}
            </h2>

            <!-- Search -->
            <div class="mb-4">
                <input 
                    type="text" 
                    x-model="searchQuery"
                    placeholder="Search by name or email..."
                    class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-teal-500 focus:border-teal-500"
                >
            </div>

            <!-- Users List -->
            <div class="space-y-2 max-h-96 overflow-y-auto">
                <template x-for="user in filteredUsers" :key="user.id">
                    <label 
                        class="flex items-center p-4 rounded-lg border transition-colors"
                        :class="user.test_assigned 
                            ? 'bg-green-50 border-green-200 cursor-not-allowed' 
                            : 'hover:bg-gray-50 border-gray-200 cursor-pointer'"
                    >
                        <input 
                            type="checkbox" 
                            :value="user.id"
                            @change="toggleUser(user.id)"
                            :checked="selectedUserIds.includes(user.id)"
                            :disabled="user.test_assigned"
                            class="w-5 h-5 text-teal-600 rounded focus:ring-teal-500 mr-4 disabled:opacity-50 disabled:cursor-not-allowed"
                        >
                        <div class="flex-1">
                            <div class="flex items-center gap-2">
                                <span class="font-medium text-gray-900" x-text="user.name"></span>
                                <span 
                                    x-show="user.test_assigned" 
                                    class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800"
                                >
                                    ✓ Already Assigned
                                </span>
                            </div>
                            <div class="text-sm text-gray-600" x-text="user.email"></div>
                            <div class="text-xs text-gray-500 mt-1">
                                <span x-text="`${user.assigned_tests_count} tests assigned`"></span>
                            </div>
                        </div>
                    </label>
                </template>

                <!-- No users found -->
                <div x-show="filteredUsers.length === 0" class="text-center py-8 text-gray-500">
                    <p>No {{ $role === 'school_admin' ? 'students' : 'employees' }} found</p>
                </div>
            </div>

            <!-- Selection Summary -->
            <div class="mt-4 p-3 bg-blue-50 rounded-lg border border-blue-200">
                <p class="text-sm text-blue-900">
                    <span class="font-semibold" x-text="selectedUserIds.length"></span> 
                    {{ $role === 'school_admin' ? 'student(s)' : 'employee(s)' }} selected
                </p>
            </div>
        </div>

        <!-- Step 3: Assign Button -->
        <div class="text-center" x-show="selectedPackage && selectedUserIds.length > 0">
            <button 
                @click="assignTest()"
                :disabled="assigning"
                class="bg-teal-600 text-white px-8 py-4 rounded-lg font-semibold text-lg hover:bg-teal-700 disabled:bg-gray-400 disabled:cursor-not-allowed transition-colors shadow-lg hover:shadow-xl"
            >
                <span x-show="!assigning">✓ Assign Test to Selected Users</span>
                <span x-show="assigning">Assigning...</span>
            </button>
        </div>
    </div>

    <!-- Success Modal -->
    <div x-show="showSuccessModal" 
         x-cloak
         class="fixed inset-0 bg-white bg-opacity-80 flex items-center justify-center z-50"
         @click.self="showSuccessModal = false">
        <div class="bg-white rounded-lg p-8 max-w-md w-full mx-4 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                    <x-lucide-check class="h-10 w-10 text-green-600" />
                </div>
                <h3 class="text-2xl font-bold text-gray-900 mb-2">Success!</h3>
                <p class="text-gray-600 mb-6" x-text="successMessage"></p>
                <button 
                    @click="showSuccessModal = false; resetForm()"
                    class="bg-teal-600 text-white px-6 py-2 rounded-lg hover:bg-teal-700 transition-colors"
                >
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
function manageTests() {
    return {
        packages: [],
        users: [],
        selectedPackage: null,
        selectedUserIds: [],
        searchQuery: '',
        loading: true,
        assigning: false,
        showSuccessModal: false,
        successMessage: '',

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
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to load packages. Please refresh the page.'
                });
            }
        },

        async loadUsers(subscriptionId = null) {
            try {
                const url = subscriptionId 
                    ? `/assignable-users?subscription_id=${subscriptionId}` 
                    : '/assignable-users';
                const response = await axios.get(url);
                
                if (response.data.status) {
                    this.users = response.data.data;
                }
            } catch (error) {
                console.error('Failed to load users:', error);
                Toast.fire({
                    icon: 'error',
                    title: 'Failed to load users. Please refresh the page.'
                });
            }
        },

        async selectPackage(packageId) {
            if (!packageId) {
                this.selectedPackage = null;
                this.users = [];
                return;
            }
            
            this.selectedPackage = this.packages.find(p => p.id == packageId);
            this.selectedUserIds = [];
            
            // Fetch users with subscription_id to get test_assigned status
            this.loading = true;
            await this.loadUsers(this.selectedPackage.subscription_id);
            this.loading = false;
        },

        toggleUser(userId) {
            const index = this.selectedUserIds.indexOf(userId);
            if (index > -1) {
                this.selectedUserIds.splice(index, 1);
            } else {
                // Check if we have enough assignments
                if(this.selectedPackage.remaining_assignments == 0){
                    Toast.fire({
                        icon: 'warning',
                        title: 'No test assignments left in this package.'
                    });
                    return;
                }
                else if (this.selectedUserIds.length >= this.selectedPackage.remaining_assignments) {
                    Toast.fire({
                        icon: 'warning',
                        title: `You can only assign ${this.selectedPackage.remaining_assignments} test(s) from this package.`
                    });
                    return;
                }
                this.selectedUserIds.push(userId);
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

        async assignTest() {
            if (!this.selectedPackage || this.selectedUserIds.length === 0) {
                Toast.fire({
                    icon: 'warning',
                    title: 'Please select a package and at least one user'
                });
                return;
            }

            this.assigning = true;

            try {
                const response = await axios.post('/assign-test', {
                    subscription_id: this.selectedPackage.id,
                    test_slug: this.selectedPackage.test_slugs[0].slug,
                    user_ids: this.selectedUserIds
                });

                if (response.data.status) {
                    this.successMessage = response.data.message;
                    this.showSuccessModal = true;
                    
                    // Reload packages to update remaining assignments
                    await this.loadPackages();
                    
                    // Reload users to update assigned test counts
                    await this.loadUsers();
                } else {
                    Toast.fire({
                        icon: 'error',
                        title: response.data.message
                    });
                }
            } catch (error) {
                console.error('Assignment failed:', error);
                Toast.fire({
                    icon: 'error',
                    title: 'An error occurred while assigning the test'
                });
            } finally {
                this.assigning = false;
            }
        },

        resetForm() {
            this.selectedPackage = null;
            this.selectedUserIds = [];
            this.searchQuery = '';
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
