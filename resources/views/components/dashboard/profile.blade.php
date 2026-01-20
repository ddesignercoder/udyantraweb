@props(['role', 'data'])

<div class="bg-white rounded-lg"> 
    
    <div class="mb-6">
        <h2 class="text-lg font-medium text-gray-900">Profile information</h2>
        <p class="text-sm text-gray-500 mt-1">
            Update your account details 
            @if(in_array($role, ['school_admin', 'company_admin'])) and organization information @endif
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST" action="{{ route('profile.update') }}" class="space-y-6 max-w-2xl">
        @csrf
        
        {{-- 1. COMMON FIELDS --}}
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Name</label>
                <input type="text" name="name" 
                       value="{{ old('name', $data['name'] ?? '') }}" 
                       class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm" required>
            </div>
            
            {{-- EMAIL (DISPLAY ONLY DIV) --}}
            <div>
                <label class="block text-sm font-medium text-gray-900 mb-2">Email address</label>
                <div class="text-sm font-mono text-gray-900 bg-gray-50 px-3 py-2 rounded border border-gray-200 truncate">
                    {{ $data['email'] ?? 'N/A' }}
                </div>
            </div>      
        </div>

        <hr class="border-gray-100">

        {{-- 2. STUDENT SPECIFIC --}}
        @if($role === 'student' && isset($data['student_profile']))
            <div class="bg-blue-50/50 p-4 rounded-lg border border-blue-100 space-y-4">
                <h3 class="text-sm font-semibold text-blue-900">Student Details</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    {{-- Read Only --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Roll Number</label>
                        <div class="text-sm font-mono text-gray-900 bg-gray-50 px-3 py-2 rounded border border-gray-200">
                            {{ $data['student_profile']['roll_no'] ?? 'N/A' }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Class</label>
                        <div class="text-sm text-gray-900 bg-gray-50 px-3 py-2 rounded border border-gray-200">
                            {{ $data['student_profile']['class'] ?? '' }}
                            @if($data['student_profile']['section'] ?? '') - {{ $data['student_profile']['section'] ?? '' }} @endif
                        </div>
                    </div>
                    {{-- Editable --}}
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-900 mb-2">Guardian Name</label>
                        <input type="text" name="guardian_name" 
                               value="{{ old('guardian_name', $data['student_profile']['guardian_name'] ?? '') }}"
                               class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm">
                    </div>
                </div>
            </div>
        @endif

        {{-- 3. EMPLOYEE SPECIFIC --}}
        @if($role === 'employee' && isset($data['employee_profile']))
            <div class="bg-gray-50 p-4 rounded-lg border border-gray-200 space-y-4">
                <h3 class="text-sm font-semibold text-gray-900">Employee Details</h3>
                <div class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                    {{-- Read Only --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Designation</label>
                        <div class="text-sm font-medium text-gray-900 px-1">
                            {{ $data['employee_profile']['designation'] ?? '---' }}
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-medium text-gray-500 uppercase mb-1">Employee ID</label>
                        <div class="text-sm font-mono text-gray-900 px-1">
                            {{ $data['employee_profile']['employee_code'] ?? '---' }}
                        </div>
                    </div>
                    {{-- Editable --}}
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-900 mb-2">Phone</label>
                        <input type="text" name="employee_phone" 
                               value="{{ old('employee_phone', $data['employee_profile']['employee_phone'] ?? '') }}"
                               class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm">
                    </div>
                </div>
            </div>
        @endif

        {{-- 4. ORGANIZATION SPECIFIC --}}
        @if(in_array($role, ['school_admin', 'company_admin']) && isset($data['organization']))
            <div class="bg-teal-50/50 p-4 rounded-lg border border-teal-100 space-y-4">
                <h3 class="text-sm font-semibold text-teal-900">Organization Details</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">Organization Name</label>
                    <input type="text" name="org_name" 
                           value="{{ old('org_name', $data['organization']['org_name'] ?? '') }}"
                           class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm">
                </div>

                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label class="block text-sm font-medium text-gray-900 mb-2">Org Email</label>
                        <input type="email" name="org_email" 
                               value="{{ old('org_email', $data['organization']['org_email'] ?? '') }}"
                               class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-900 mb-2">Org Phone</label>
                        <input type="text" name="org_phone" 
                               value="{{ old('org_phone', $data['organization']['org_phone'] ?? '') }}"
                               class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">GST Number</label>
                    <input type="text" name="gst_number" 
                           value="{{ old('gst_number', $data['organization']['gst_number'] ?? '') }}"
                           class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm uppercase">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-900 mb-2">Address</label>
                    <textarea name="address" rows="2" 
                              class="w-full rounded-md border border-gray-300 py-2 px-3 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm">{{ old('address', $data['organization']['address'] ?? '') }}</textarea>
                </div>
            </div>
        @endif

        {{-- SAVE BUTTON --}}
        <div class="pt-4 flex items-center justify-end">
            <button type="submit" class="bg-primary text-white px-6 py-2 rounded-md text-sm font-medium hover:bg-white hover:text-primary hover:border hover:border-primary transition-colors cursor-pointer">
                Save Changes
            </button>
        </div>

    </form>
</div>