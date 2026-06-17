@props(['encryptedUserId'])

<div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-all duration-300">
    <div class="bg-white rounded-2xl p-6 max-w-sm w-full mx-4 shadow-xl border border-gray-100 transform scale-95 transition-transform duration-300" id="delete-modal-card">
        <div class="flex flex-col items-center text-center">
            <div class="bg-red-50 p-3 rounded-full text-red-500 mb-4">
                <x-lucide-alert-triangle class="w-8 h-8" />
            </div>
            
            <h3 class="text-lg font-bold text-gray-900 mb-2">Delete Note</h3>
            <p class="text-sm text-gray-500 mb-6 leading-relaxed">
                Are you sure you want to delete this note?
            </p>
            
            <div class="flex items-center gap-3 w-full">
                <button type="button" onclick="closeDeleteModal()" class="w-1/2 px-4 py-2 border border-gray-300 rounded-xl text-sm font-semibold text-gray-700 hover:bg-gray-50 transition cursor-pointer">
                    Cancel
                </button>
                <form id="delete-modal-form" method="POST" class="w-1/2">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="user_id" value="{{ $encryptedUserId }}">
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-xl text-sm font-semibold shadow-sm transition cursor-pointer">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
