<!-- USER PROFILE BOTTOM (Fixed at bottom) -->

<div class="border-t border-gray-200 p-2 relative" 
        x-data="{ open: false }" 
        @click.away="open = false">
    
    {{-- 1. THE POP-UP MENU --}}
    <div x-show="open" 
            x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 translate-y-2"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-150"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-2"
            style="display: none;" 
            class="absolute bottom-full left-0 w-[calc(100%-1rem)] mx-2 mb-2 bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden z-50">
        
        {{-- Header: Name & Email --}}
        <div class="px-4 py-3 border-b border-gray-100 flex items-center gap-3">
                <div class="h-10 w-10 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg shrink-0">
                {{ substr(session('user_name', 'U'), 0, 1) }}
            </div>
            <div class="overflow-hidden">
                <p class="text-sm font-semibold text-textBlack truncate">{{ session('user_name') }}</p>
                <p class="text-xs text-gray-500 truncate">{{ session('user_email', 'user@example.com') }}</p>
            </div>
        </div>

        {{-- Menu Links --}}
        <div class="pt-1">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2.5 text-sm text-gray-700 hover:bg-gray-50 hover:text-black transition-colors border-b border-gray-100">
                <x-lucide-settings class="w-4 h-4 text-gray-400" />
                Settings
            </a>
            
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors text-left cursor-pointer">
                    <x-lucide-log-out class="w-4 h-4" />
                    Log out
                </button>
            </form>
        </div>
    </div>

    {{-- 2. THE TRIGGER BUTTON --}}
    <button @click="open = !open" 
            class="flex items-center justify-between w-full p-2 rounded-xl hover:bg-white hover:shadow-sm hover:cursor-pointer transition-all duration-200 group">
        
        <div class="flex items-center gap-3 overflow-hidden">
            {{-- Avatar --}}
            <div class="h-9 w-9 rounded-full bg-primary flex items-center justify-center text-white font-bold text-sm shrink-0">
                {{ substr(session('user_name', 'P'), 0, 1) }}
            </div>
            
            {{-- Name --}}
            <span class="text-sm font-medium text-gray-700 truncate group-hover:text-gray-900">
                {{ session('user_name') }}
            </span>
        </div>

        {{-- Up/Down Chevron Icon --}}
        <x-lucide-chevrons-up-down class="w-4 h-4 text-black" />
    </button>

</div>