@extends('layouts.dashboard')

@section('title', 'Notes for ' . $user['name'])

@section('content')
<div class="max-w-7xl mx-auto py-4 px-4 sm:py-6 sm:px-6">
    
    {{-- HEADER CONTAINER --}}
    <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6 sm:mb-8">
        {{-- BACK TO LIST BUTTON --}}
        <div>
            <a href="{{ route('dashboard.list-users') }}" class="inline-flex items-center gap-2 text-sm font-semibold text-gray-600 hover:text-gray-900 transition">
                <x-lucide-arrow-left class="w-4 h-4" />
                Back to {{ session('user_role') == 'school_admin' ? 'Students List' : 'Employees List' }}
            </a>
        </div>

        {{-- HEADER CARD --}}
        <div class="bg-primary rounded-2xl p-4 sm:p-6 text-white shadow-md">
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="bg-white/20 p-2 sm:p-3 rounded-xl">
                    <x-lucide-user class="w-6 h-6 sm:w-8 sm:h-8 text-white" />
                </div>
                <div>
                    <h1 class="text-lg sm:text-xl font-bold">{{ $user['name'] }}</h1>
                    <p class="text-white/80 text-xs sm:text-sm mt-1">{{ $user['email'] }}</p>
                </div>
            </div>
        </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
        
        {{-- LEFT COLUMN: ADD NOTE FORM --}}
        <div class="md:col-span-1">
            <div class="bg-white p-4 sm:p-5 rounded-xl border border-gray-200 shadow-sm md:sticky md:top-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                    <x-lucide-plus-circle class="w-5 h-5 text-primary" />
                    Add New Note
                </h2>
                
                <form action="{{ route('users.notes.store', ['id' => $encrypted_user_id]) }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="content" class="block text-xs font-semibold text-gray-500 uppercase mb-2">Note Content</label>
                        <textarea 
                            name="content" 
                            id="content" 
                            rows="4" 
                            required
                            placeholder="Write your note here..."
                            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition"
                        ></textarea>
                        @error('content')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <button type="submit" class="w-full bg-primary hover:bg-primary-dark/85 text-white text-sm font-bold py-2.5 px-4 rounded-lg transition duration-200 flex items-center justify-center gap-2 cursor-pointer shadow-sm">
                        <x-lucide-save class="w-4 h-4" />
                        Save Note
                    </button>
                </form>
            </div>
        </div>

        {{-- RIGHT COLUMN: NOTES LIST --}}
        <div class="md:col-span-2">
            <div class="bg-white p-4 sm:p-6 rounded-xl border border-gray-200 shadow-sm min-h-[300px] sm:min-h-[400px]">
                <h2 class="text-lg font-bold text-gray-900 mb-4 sm:mb-6 flex items-center gap-2">
                    <x-lucide-notebook class="w-5 h-5 text-primary" />
                    Notes History
                </h2>

                @forelse($notes as $note)
                    <div class="border-l-2 border-primary/20 pl-4 sm:pl-6 pb-6 sm:pb-8 relative last:pb-0">
                        {{-- Dot Indicator --}}
                        <div class="absolute -left-[6px] top-1.5 w-2.5 h-2.5 rounded-full bg-primary ring-4 ring-primary/10"></div>

                        {{-- VIEW STATE --}}
                        <div id="note-view-{{ $note['id'] }}" class="space-y-2">
                            <div class="flex flex-col sm:flex-row sm:items-start justify-between gap-3 sm:gap-4">
                                <div class="bg-gray-50 rounded-xl p-3 sm:p-4 text-gray-700 text-sm w-full leading-relaxed break-words whitespace-pre-line">
                                    {{ $note['content'] }}
                                </div>
                                
                                {{-- ACTIONS --}}
                                <div class="flex items-center sm:justify-start justify-end gap-1 shrink-0">
                                    <button onclick="toggleEdit({{ $note['id'] }})" class="p-1.5 text-gray-400 hover:text-primary rounded-lg hover:bg-gray-100 transition" title="Edit Note">
                                        <x-lucide-pencil class="w-4 h-4" />
                                    </button>
                                    <button type="button" 
                                            onclick="confirmDelete({{ $note['id'] }}, '{{ route('notes.destroy', ['noteId' => $note['id']]) }}')" 
                                            class="p-1.5 text-gray-400 hover:text-red-600 rounded-lg hover:bg-gray-100 transition" 
                                            title="Delete Note">
                                        <x-lucide-trash-2 class="w-4 h-4" />
                                    </button>
                                </div>
                            </div>
                            
                            {{-- META --}}
                            <div class="flex items-center gap-2 text-xs text-gray-400 pl-1">
                                <span class="font-medium text-gray-500">{{ $note['admin']['name'] ?? 'Admin' }}</span>
                                <span>•</span>
                                <span>{{ \Carbon\Carbon::parse($note['created_at'])->setTimezone('Asia/Kolkata')->format('d M, Y \a\t h:i A') }}</span>
                            </div>
                        </div>

                        <x-notes.notes-edit :note="$note" :encryptedUserId="$encrypted_user_id" />
                    </div>
                @empty
                    <div class="flex flex-col items-center justify-center py-12 text-gray-400">
                        <x-lucide-sticky-note class="w-12 h-12 text-gray-200 mb-3" />
                        <p class="text-sm font-medium">No notes recorded yet.</p>
                        <p class="text-xs text-gray-400 mt-1">Use the panel on the left to write the first note.</p>
                    </div>
                @endforelse

                {{-- Pagination Links --}}
                @if($notes->hasPages())
                    {{ $notes->links('components.notes.notes-pagenation') }}
                @endif

            </div>
        </div>

    </div>

</div>

<x-notes.notes-delete :encryptedUserId="$encrypted_user_id" />

<script>
    function toggleEdit(id) {
        const viewDiv = document.getElementById(`note-view-${id}`);
        const editDiv = document.getElementById(`note-edit-${id}`);
        
        if (viewDiv.classList.contains('hidden')) {
            viewDiv.classList.remove('hidden');
            editDiv.classList.add('hidden');
        } else {
            viewDiv.classList.add('hidden');
            editDiv.classList.remove('hidden');
        }
    }

    function confirmDelete(id, actionUrl) {
        const modal = document.getElementById('delete-modal');
        const card = document.getElementById('delete-modal-card');
        const form = document.getElementById('delete-modal-form');
        
        form.action = actionUrl;
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            card.classList.remove('scale-95');
            card.classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('delete-modal');
        const card = document.getElementById('delete-modal-card');
        
        card.classList.remove('scale-100');
        card.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.remove('flex');
            modal.classList.add('hidden');
        }, 150);
    }
</script>
@endsection