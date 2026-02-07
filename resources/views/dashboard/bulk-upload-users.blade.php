@extends('layouts.dashboard')

@section('title', $role === 'school_admin' ? 'Bulk Upload Students' : 'Bulk Upload Employees')

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6">
    
    <!-- Header -->
    <div class="mb-6 md:mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-xl md:text-2xl font-bold text-gray-900">
                {{ $role === 'school_admin' ? 'Bulk Upload Students' : 'Bulk Upload Employees' }}
            </h1>
            <p class="text-sm md:text-base text-gray-600 mt-1">Upload a CSV file to register multiple users at once.</p>
        </div>
        <a href="{{ asset('assets/users-bulk-upload-sample/' . ($role === 'school_admin' ? 'students_sample.csv' : 'employees_sample.csv')) }}" 
           download 
           class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-4 py-2.5 bg-primary hover:bg-white text-white hover:text-primary border border-primary rounded-lg font-medium text-sm transition">
            <x-lucide-download class="w-4 h-4" />
            Download Sample CSV
        </a>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-xl flex items-start gap-3">
            <x-lucide-check-circle class="w-6 h-6 text-green-500 shrink-0" />
            <p class="text-green-800 font-medium">{{ session('success') }}</p>
        </div>
    @endif

    @if(session('warning'))
        <div class="mb-6 p-4 bg-amber-50 border border-amber-200 rounded-xl">
            <div class="flex items-start gap-3">
                <x-lucide-alert-triangle class="w-6 h-6 text-amber-500 shrink-0" />
                <p class="text-amber-800 font-medium">{{ session('warning') }}</p>
            </div>
            @if(session('bulk_errors'))
                <div class="mt-4 max-h-48 overflow-y-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-amber-100 sticky top-0">
                            <tr>
                                <th class="px-3 py-2 text-left text-amber-800">Row</th>
                                <th class="px-3 py-2 text-left text-amber-800">Field</th>
                                <th class="px-3 py-2 text-left text-amber-800">Error</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-amber-100">
                            @foreach(session('bulk_errors') as $error)
                                <tr>
                                    <td class="px-3 py-2 text-amber-700">{{ $error['row'] ?? '-' }}</td>
                                    <td class="px-3 py-2 text-amber-700 font-medium">{{ $error['field'] ?? '-' }}</td>
                                    <td class="px-3 py-2 text-amber-700">{{ $error['message'] ?? '-' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl flex items-start gap-3">
            <x-lucide-x-circle class="w-6 h-6 text-red-500 shrink-0" />
            <p class="text-red-800 font-medium">{{ session('error') }}</p>
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl">
            <div class="flex items-start gap-3">
                <x-lucide-alert-circle class="w-6 h-6 text-red-500 shrink-0" />
                <div>
                    <p class="text-red-800 font-medium">Please fix the following errors:</p>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <!-- Upload Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden" x-data="{ isUploading: false }">
        <form action="{{ route('org.bulk-upload-users') }}" method="POST" enctype="multipart/form-data" id="uploadForm" @submit="isUploading = true">
            @csrf
            
            <div class="p-6 md:p-8">
                <!-- Drag & Drop Zone -->
                <div x-data="csvUpload()" 
                     @click="$refs.fileInput.click()"
                     @dragover.prevent="isDragging = true"
                     @dragleave.prevent="isDragging = false"
                     @drop.prevent="handleDrop($event)"
                     :class="{ 'border-primary bg-primary/10': isDragging }"
                     class="border-2 border-dashed border-gray-300 rounded-xl p-6 md:p-8 text-center hover:border-primary hover:bg-primary/5 transition-all cursor-pointer">
                    <input type="file" name="csv_file" x-ref="fileInput" @change="handleFileSelect($event)" accept=".csv" class="hidden" required>
                    
                    <!-- Upload Prompt -->
                    <div x-show="!hasFile">
                        <div class="w-14 h-14 md:w-16 md:h-16 bg-primary/10 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                            <x-lucide-cloud-upload class="w-7 h-7 md:w-8 md:h-8 text-primary" />
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-2">Drop your CSV file here</h3>
                        <p class="text-sm text-gray-500 mb-4">or click to browse from your computer</p>
                        <span class="inline-block px-4 py-2.5 bg-primary hover:bg-white hover:text-primary border border-primary text-white rounded-lg font-medium text-sm">
                            Select CSV File
                        </span>
                    </div>

                    <!-- File Preview -->
                    <div x-show="hasFile" x-cloak>
                        <div class="w-14 h-14 md:w-16 md:h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3 md:mb-4">
                            <x-lucide-check-circle class="w-7 h-7 md:w-8 md:h-8 text-green-600" />
                        </div>
                        <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-1" x-text="fileName">filename.csv</h3>
                        <p class="text-gray-500 text-sm" x-text="fileSize">0 KB</p>
                        <button type="button" @click.stop="removeFile()" class="mt-3 bg-white border border-red-500 rounded-lg px-4 py-2.5 text-red-500 hover:bg-red-500 hover:text-white text-sm font-medium cursor-pointer">
                            Remove file
                        </button>
                    </div>
                </div>

                <!-- CSV Format Guide -->
                <div class="mt-6 md:mt-8">
                    <h3 class="text-base md:text-lg font-semibold text-gray-800 mb-3 md:mb-4 flex items-center gap-2">
                        <x-lucide-info class="w-5 h-5 text-primary" />
                        CSV Format Guide
                    </h3>
                    
                    <div class="bg-gray-50 rounded-lg p-4 overflow-x-auto">
                        @if($role === 'school_admin')
                            <p class="text-sm text-gray-600 mb-3">Your CSV file should have the following columns:</p>
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">name</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">email</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">password</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">roll_no</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">class</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">section</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">guardian_name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="px-3 py-2 text-gray-600">John Doe</td>
                                        <td class="px-3 py-2 text-gray-600">john@email.com</td>
                                        <td class="px-3 py-2 text-gray-600">Pass@123</td>
                                        <td class="px-3 py-2 text-gray-600">2024001</td>
                                        <td class="px-3 py-2 text-gray-600">10</td>
                                        <td class="px-3 py-2 text-gray-600">A</td>
                                        <td class="px-3 py-2 text-gray-600">Jane Doe</td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                            <p class="text-sm text-gray-600 mb-3">Your CSV file should have the following columns:</p>
                            <table class="w-full text-sm">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">name</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">email</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">password</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">employee_code</th>
                                        <th class="px-3 py-2 text-left text-gray-700 font-semibold">designation</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="bg-white">
                                        <td class="px-3 py-2 text-gray-600">John Doe</td>
                                        <td class="px-3 py-2 text-gray-600">john@company.com</td>
                                        <td class="px-3 py-2 text-gray-600">Pass@123</td>
                                        <td class="px-3 py-2 text-gray-600">EMP001</td>
                                        <td class="px-3 py-2 text-gray-600">Software Engineer</td>
                                    </tr>
                                </tbody>
                            </table>
                        @endif
                    </div>

                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex items-start gap-3 p-3 bg-blue-50 rounded-lg">
                            <x-lucide-file-text class="w-5 h-5 text-blue-500 shrink-0 mt-0.5" />
                            <div>
                                <p class="text-sm font-medium text-blue-800">File Requirements</p>
                                <p class="text-xs text-blue-600 mt-1">CSV format only | max 5MB</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 p-3 bg-amber-50 rounded-lg">
                            <x-lucide-alert-triangle class="w-5 h-5 text-amber-500 shrink-0 mt-0.5" />
                            <div>
                                <p class="text-sm font-medium text-amber-800">Important</p>
                                <p class="text-xs text-amber-600 mt-1">First row must be column headers</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Footer Actions -->
            <div class="flex flex-col-reverse sm:flex-row items-center justify-end gap-3 sm:gap-4 bg-gray-50 p-4 md:p-6 border-t border-gray-200">
                <a href="{{ route('dashboard.list-users') }}" class="w-full sm:w-auto text-center text-gray-600 hover:text-gray-900 font-medium py-2.5" :class="{ 'pointer-events-none opacity-50': isUploading }">Cancel</a>
                <button type="submit" x-data x-bind:disabled="!$store.csvUpload.hasFile || isUploading" class="w-full sm:w-auto bg-primary text-white px-6 py-2.5 rounded-lg font-semibold shadow hover:bg-primary-dark/80 transition disabled:opacity-50 disabled:cursor-not-allowed flex items-center justify-center gap-2">
                    <x-lucide-upload class="w-5 h-5" x-show="!isUploading" />
                    <x-lucide-loader-2 class="w-5 h-5 animate-spin" x-show="isUploading" />
                    <span x-text="isUploading ? 'Uploading...' : 'Upload & Register'">Upload & Register</span>
                </button>
            </div>
        </form>

        <!-- Loading Overlay -->
        <div x-show="isUploading" x-cloak class="fixed inset-0 bg-black/50 backdrop-blur-sm z-50 flex items-center justify-center">
            <div class="bg-white rounded-xl p-8 shadow-2xl max-w-sm mx-4 text-center">
                <div class="w-16 h-16 border-4 border-primary border-t-transparent rounded-full animate-spin mx-auto mb-4"></div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">Processing Upload</h3>
                <p class="text-sm text-gray-600">Please wait while we register the users...</p>
            </div>
        </div>
    </div>
</div>

<script>
// Alpine.js store for global state
document.addEventListener('alpine:init', () => {
    Alpine.store('csvUpload', {
        hasFile: false
    });
});

// Alpine.js component for CSV upload
function csvUpload() {
    return {
        isDragging: false,
        hasFile: false,
        fileName: '',
        fileSize: '',
        maxFileSize: 5 * 1024 * 1024, // 5MB

        handleFileSelect(event) {
            const file = event.target.files[0];
            if (file) this.processFile(file);
        },

        handleDrop(event) {
            this.isDragging = false;
            const file = event.dataTransfer.files[0];
            if (file) {
                this.$refs.fileInput.files = event.dataTransfer.files;
                this.processFile(file);
            }
        },

        processFile(file) {
            // Validate file size (5MB max)
            if (file.size > this.maxFileSize) {
                Toast.fire({
                    icon: 'error',
                    title: 'File size exceeds 5MB limit. Please upload a smaller file.'
                });
                this.$refs.fileInput.value = '';
                return;
            }

            this.fileName = file.name;
            this.fileSize = this.formatFileSize(file.size);
            this.hasFile = true;
            Alpine.store('csvUpload').hasFile = true;
        },

        removeFile() {
            this.$refs.fileInput.value = '';
            this.hasFile = false;
            this.fileName = '';
            this.fileSize = '';
            Alpine.store('csvUpload').hasFile = false;
        },

        formatFileSize(bytes) {
            if (bytes === 0) return '0 Bytes';
            const k = 1024;
            const sizes = ['Bytes', 'KB', 'MB'];
            const i = Math.floor(Math.log(bytes) / Math.log(k));
            return parseFloat((bytes / Math.pow(k, i)).toFixed(2)) + ' ' + sizes[i];
        }
    }
}
</script>
@endsection