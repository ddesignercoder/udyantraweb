@props(['note', 'encryptedUserId'])

<div id="note-edit-{{ $note['id'] }}" class="hidden">
    <form action="{{ route('notes.update', ['noteId' => $note['id']]) }}" method="POST" class="bg-gray-50 border border-primary/20 rounded-xl p-4 space-y-3">
        @csrf
        @method('PUT')
        <input type="hidden" name="user_id" value="{{ $encryptedUserId }}">
        <textarea 
            name="content" 
            rows="3" 
            required
            class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-primary focus:border-primary outline-none transition bg-white"
        >{{ $note['content'] }}</textarea>
        
        <div class="flex justify-end gap-2">
            <button type="button" onclick="toggleEdit({{ $note['id'] }})" class="px-3 py-1.5 border border-gray-300 text-gray-700 rounded-lg text-xs font-semibold hover:bg-gray-100 transition cursor-pointer">
                Cancel
            </button>
            <button type="submit" class="px-3 py-1.5 bg-primary hover:bg-primary-dark/85 text-white rounded-lg text-xs font-semibold shadow-sm transition cursor-pointer">
                Save Changes
            </button>
        </div>
    </form>
</div>
