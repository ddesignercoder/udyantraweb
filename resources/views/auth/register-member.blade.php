@extends('layouts.client')

@section('title', 'Registration | Udyantra Career Assessment Tool')
@section('description', 'Register under your school or company organization to start your career assessment test on Udyantra.')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl w-full space-y-8 bg-white rounded-xl shadow-lg p-2">
        
        <div class="text-center">
            <h2 class="text-3xl font-extrabold text-gray-900">
                Registration Now
            </h2>
            @if(isset($organization))
                <p class="mt-2 text-sm text-gray-600">
                    Registering as a <span class="text-primary font-semibold">{{ $organization['type'] === 'school' ? 'Student' : 'Employee' }}</span> under 
                    <span class="text-primary font-semibold">{{ $organization['name'] }}</span>
                </p>
            @else
                <p class="mt-2 text-sm text-gray-600">
                    Register under your School or Company organization
                </p>
            @endif
        </div>

        @if(session('error'))
            <div class="bg-red-50 border-l-4 border-red-400 p-4 rounded-md">
                <p class="text-sm text-red-700">{{ session('error') }}</p>
            </div>
        @endif

        <form novalidate class="mt-8 space-y-6" action="{{ route('register.member.submit') }}" method="POST">
            @csrf 
            <input type="hidden" name="trackingparam" value="{{ request('trackingparam') }}">
            
            <input type="hidden" name="organization_id" value="{{ $orgId }}">
            <input type="hidden" name="role" value="{{ $organization['type'] === 'school' ? 'student' : 'employee' }}">
            <input type="hidden" name="form_tag" value="{{ $formTag }}">
            
            <div class="rounded-2xl space-y-4 p-2">
                
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="John Doe">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p id="js-error-name" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" name="email" type="email" required value="{{ old('email') }}"
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="john@example.com">
                    @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p id="js-error-email" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>


                <!-- Student Profile Fields -->
                <div id="student_fields" class="space-y-4 {{ (isset($organization) && $organization['type'] === 'school') ? '' : 'hidden' }}">
                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                        <input id="phone" name="phone" type="text" value="{{ old('phone') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. +1234567890">
                        @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p id="js-error-phone" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <div>
                        <label for="roll_no" class="block text-sm font-medium text-gray-700">Roll Number</label>
                        <input id="roll_no" name="roll_no" type="text" value="{{ old('roll_no') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. 101">
                        @error('roll_no') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p id="js-error-roll_no" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <div>
                        <label for="class_select" class="block text-sm font-medium text-gray-700">Class</label>
                        <select id="class_select" name="class" required
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-white transition-colors">
                            <option value="">Select Class</option>
                            <option value="9" {{ old('class') == '9' ? 'selected' : '' }}>9</option>
                            <option value="10" {{ old('class') == '10' ? 'selected' : '' }}>10</option>
                            <option value="11" {{ old('class') == '11' ? 'selected' : '' }}>11</option>
                            <option value="12" {{ old('class') == '12' ? 'selected' : '' }}>12</option>
                            <option value="Other" {{ old('class') == 'Other' ? 'selected' : '' }}>Other</option>
                        </select>
                        @error('class') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p id="js-error-class_select" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <div>
                        <label for="section" class="block text-sm font-medium text-gray-700">Section (Optional)</label>
                        <input id="section" name="section" type="text" value="{{ old('section') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. A">
                        @error('section') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="guardian_name" class="block text-sm font-medium text-gray-700">Guardian Name</label>
                        <input id="guardian_name" name="guardian_name" type="text" value="{{ old('guardian_name') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. Robert Doe">
                        @error('guardian_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p id="js-error-guardian_name" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>


                    <div>
                        <label for="state" class="block text-sm font-medium text-gray-700">State</label>
                        <select id="state" name="state"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-white transition-colors">
                            <option value="">Select State</option>
                        </select>
                        @error('state') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label for="city" class="block text-sm font-medium text-gray-700">City</label>
                        <input id="city" name="city" type="text" value="{{ old('city') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. Noida">
                        @error('city') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- Employee Profile Fields -->
                <div id="employee_fields" class="space-y-4 {{ (isset($organization) && $organization['type'] === 'company') ? '' : 'hidden' }}">
                    <div>
                        <label for="employee_code" class="block text-sm font-medium text-gray-700">Employee Code</label>
                        <input id="employee_code" name="employee_code" type="text" value="{{ old('employee_code') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. EMP123">
                        @error('employee_code') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        <p id="js-error-employee_code" class="text-red-500 text-xs mt-1 hidden"></p>
                    </div>

                    <div>
                        <label for="designation" class="block text-sm font-medium text-gray-700">Designation (Optional)</label>
                        <input id="designation" name="designation" type="text" value="{{ old('designation') }}"
                            class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                            placeholder="e.g. Software Engineer">
                        @error('designation') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="••••••••">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    <p id="js-error-password" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                        class="appearance-none relative block w-full px-4 py-3 border border-secondary placeholder-gray-400 text-textBlack rounded-full focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent sm:text-sm bg-lightgray transition-colors" 
                        placeholder="••••••••">
                    <p id="js-error-password_confirmation" class="text-red-500 text-xs mt-1 hidden"></p>
                </div>
            </div>

            <div class="flex items-center justify-center">
                <button type="submit" class="group relative md:w-1/4  py-3 px-4 border border-transparent text-sm font-bold rounded-full text-white bg-primary hover:bg-primary-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition cursor-pointer">
                    Register and Start Test
                </button>
            </div>

        </form>
        <!-- <div class="text-center mt-4">
            <p class="text-sm text-textBlack">
                Already have an account? 
                <a href="#" class="font-medium text-primary hover:text-primary-dark transition-colors">
                    Login here
                </a>
            </p>
        </div> -->
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function () {
    const states = [
        "Andhra Pradesh", "Arunachal Pradesh", "Assam", "Bihar", "Chhattisgarh", "Goa", "Gujarat", 
        "Haryana", "Himachal Pradesh", "Jharkhand", "Karnataka", "Kerala", "Madhya Pradesh", 
        "Maharashtra", "Manipur", "Meghalaya", "Mizoram", "Nagaland", "Odisha", "Punjab", 
        "Rajasthan", "Sikkim", "Tamil Nadu", "Telangana", "Tripura", "Uttar Pradesh", 
        "Uttarakhand", "West Bengal", "Andaman and Nicobar Islands", "Chandigarh", 
        "Dadra and Nagar Haveli and Daman and Diu", "Delhi", "Jammu and Kashmir", 
        "Ladakh", "Lakshadweep", "Puducherry"
    ];
    
    const stateSelect = document.getElementById('state');
    if (stateSelect) {
        const selectedState = "{{ old('state') }}";
        states.forEach(state => {
            const option = document.createElement('option');
            option.value = state;
            option.textContent = state;
            if (state === selectedState) {
                option.selected = true;
            }
            stateSelect.appendChild(option);
        });
    }

    // Client-side form validation
    const form = document.querySelector('form');
    if (form) {
        form.addEventListener('submit', function (e) {
            let hasErrors = false;
            
            function setError(fieldId, message) {
                const errorEl = document.getElementById('js-error-' + fieldId);
                const inputEl = document.getElementById(fieldId);
                if (errorEl) {
                    if (message) {
                        errorEl.textContent = message;
                        errorEl.classList.remove('hidden');
                        if (inputEl) {
                            inputEl.classList.add('border-red-500');
                            inputEl.classList.remove('border-secondary');
                        }
                        hasErrors = true;
                    } else {
                        errorEl.textContent = '';
                        errorEl.classList.add('hidden');
                        if (inputEl) {
                            inputEl.classList.remove('border-red-500');
                            inputEl.classList.add('border-secondary');
                        }
                    }
                }
            }

            // 1. Validate Name
            const name = document.getElementById('name').value.trim();
            if (!name) {
                setError('name', 'Full Name is required.');
            } else {
                setError('name', '');
            }

            // 2. Validate Email
            const email = document.getElementById('email').value.trim();
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!email) {
                setError('email', 'Email Address is required.');
            } else if (!emailRegex.test(email)) {
                setError('email', 'Please enter a valid email address.');
            } else {
                setError('email', '');
            }

            // 3. Conditional Fields based on Organization Type
            const isSchool = {{ $organization['type'] === 'school' ? 'true' : 'false' }};
            if (isSchool) {
                // Validate Phone
                const phone = document.getElementById('phone').value.trim();
                const phoneRegex = /^\+?[0-9]{10,15}$/;
                if (!phone) {
                    setError('phone', 'Phone Number is required.');
                } else if (!phoneRegex.test(phone)) {
                    setError('phone', 'Please enter a valid phone number (10 to 15 digits).');
                } else {
                    setError('phone', '');
                }

                // Validate Roll No
                const rollNo = document.getElementById('roll_no').value.trim();
                if (!rollNo) {
                    setError('roll_no', 'Roll Number is required.');
                } else {
                    setError('roll_no', '');
                }

                // Validate Class
                const classSelect = document.getElementById('class_select').value;
                if (!classSelect) {
                    setError('class_select', 'Please select your class.');
                } else {
                    setError('class_select', '');
                }

                // Validate Guardian Name
                const guardian = document.getElementById('guardian_name').value.trim();
                if (!guardian) {
                    setError('guardian_name', 'Guardian Name is required.');
                } else {
                    setError('guardian_name', '');
                }
            } else {
                // Validate Employee Code
                const empCode = document.getElementById('employee_code').value.trim();
                if (!empCode) {
                    setError('employee_code', 'Employee Code is required.');
                } else {
                    setError('employee_code', '');
                }
            }

            // 4. Validate Password
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;
            if (!password) {
                setError('password', 'Password is required.');
            } else if (password.length < 6) {
                setError('password', 'Password must be at least 6 characters.');
            } else {
                setError('password', '');
            }

            // 5. Validate Password Confirmation
            if (password !== confirmPassword) {
                setError('password_confirmation', 'Passwords do not match.');
            } else {
                setError('password_confirmation', '');
            }

            // Stop submission if there are validation errors
            if (hasErrors) {
                e.preventDefault();
                
                // Smooth scroll to the first visible error
                const firstError = document.querySelector('.text-red-500:not(.hidden)');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }
});
</script>
@endsection
