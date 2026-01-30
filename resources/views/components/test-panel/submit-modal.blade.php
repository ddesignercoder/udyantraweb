<!-- Submit Confirmation Modal Component -->
<div x-show="showSubmitModal" 
    x-transition.opacity.duration.300ms
    class="fixed inset-0 z-60 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4"
    style="display: none;"
    @click.self="showSubmitModal = false">
    
    <div x-show="showSubmitModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="bg-white rounded-lg shadow-2xl max-w-md w-full overflow-hidden">
        
        <!-- Modal Header -->
        <div class="bg-linear-to-r from-primary to-primary/80 px-6 py-4">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 bg-white/20 rounded-full flex items-center justify-center">
                    <x-lucide-circle-check class="w-6 h-6 text-white" />
                </div>
                <h3 class="text-xl font-bold text-white">Submit Test</h3>
            </div>
        </div>

        <!-- Modal Body -->
        <div class="px-6 py-6">
            <p class="text-gray-700 text-base leading-relaxed mb-4">
                Are you sure you want to submit your test? Once submitted, you won't be able to make any changes.
            </p>
            
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 space-y-2">
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Total Questions:</span>
                    <span class="font-bold text-gray-800" x-text="questions.length"></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Answered:</span>
                    <span class="font-bold text-green-600" x-text="Object.keys(answers).length"></span>
                </div>
                <div class="flex justify-between text-sm">
                    <span class="text-gray-600">Unanswered:</span>
                    <span class="font-bold text-red-600" x-text="questions.length - Object.keys(answers).length"></span>
                </div>
            </div>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end">
            <button @click="showSubmitModal = false" 
                class="px-6 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 font-semibold hover:bg-gray-100 transition-colors duration-200">
                Cancel
            </button>
            <button @click="confirmSubmit()" 
                class="px-6 py-2.5 rounded-lg bg-linear-to-r from-green-600 to-green-700 text-white font-semibold hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transition-all duration-200">
                Yes, Submit
            </button>
        </div>
    </div>
</div>
