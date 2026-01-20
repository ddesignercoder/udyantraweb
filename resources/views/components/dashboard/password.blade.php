<div class="bg-white rounded-lg"> 
    
    <div class="mb-6">
        <h2 class="text-lg font-medium text-gray-900">Update password</h2>
        <p class="text-sm text-gray-500 mt-1">
            Ensure your account is using a long, random password to stay secure
        </p>
    </div>

    {{-- FORM --}}
    <form method="POST" action="{{ route('password.update') }}" class="space-y-6 max-w-2xl">
        @csrf
        
        <div class="grid grid-cols-1 gap-6">
            
            {{-- Current Password --}}
            <div x-data="{ show: true }">
                <label for="current_password" class="block text-sm font-medium text-gray-900 mb-2">Current password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="current_password" id="current_password"
                           class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm" 
                           autocomplete="current-password">
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 cursor-pointer focus:outline-none">
                        <x-lucide-eye x-show="!show" class="h-4 w-4" />
                        <x-lucide-eye-off x-show="show" class="h-4 w-4" style="display: none;" />
                    </button>
                </div>
                @error('current_password', 'updatePassword') 
                    <span class="text-xs text-red-500">{{ $message }}</span> 
                @enderror
            </div>

            {{-- New Password --}}
            <div x-data="{ show: true }">
                <label for="password" class="block text-sm font-medium text-gray-900 mb-2">New password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password" id="password"
                           class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm" 
                           autocomplete="new-password">
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 cursor-pointer focus:outline-none">
                        <x-lucide-eye x-show="!show" class="h-4 w-4" />
                        <x-lucide-eye-off x-show="show" class="h-4 w-4" style="display: none;" />
                    </button>
                </div>
                @error('password', 'updatePassword') 
                    <span class="text-xs text-red-500">{{ $message }}</span> 
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div x-data="{ show: false }">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-900 mb-2">Confirm password</label>
                <div class="relative">
                    <input :type="show ? 'text' : 'password'" name="password_confirmation" id="password_confirmation"
                           class="w-full rounded-md border border-gray-300 py-2 pl-3 pr-10 text-gray-900 shadow-sm focus:border-black focus:ring-1 focus:ring-black sm:text-sm" 
                           autocomplete="new-password">
                    
                    <button type="button" @click="show = !show" class="absolute inset-y-0 right-0 flex items-center px-3 text-gray-500 hover:text-gray-700 cursor-pointer focus:outline-none">
                        <x-lucide-eye x-show="!show" class="h-4 w-4" />
                        <x-lucide-eye-off x-show="show" class="h-4 w-4" style="display: none;" />
                    </button>
                </div>
                @error('password_confirmation', 'updatePassword') 
                    <span class="text-xs text-red-500">{{ $message }}</span> 
                @enderror
            </div>

        </div>

        {{-- SAVE BUTTON --}}
        <div class="pt-4 flex items-center justify-end">
            <button type="submit" class="bg-primary text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-white hover:text-primary hover:border hover:border-primary border border-transparent transition-colors cursor-pointer shadow-sm">
                Save password
            </button>
        </div>

    </form>
</div>