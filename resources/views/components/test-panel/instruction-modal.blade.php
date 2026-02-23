<!-- Submit Confirmation Modal Component -->
<div x-show="showInstructionModal" 
    x-transition.opacity.duration.300ms
    class="fixed inset-0 z-60 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 "
    @click.self="showInstructionModal = false">
    
    <div x-show="showInstructionModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="bg-white rounded-lg shadow-2xl max-w-4xl w-full  max-h-9/10 md:max-h-screen overflow-y-auto px-6 py-4">
        
        <!-- Modal Header -->
        <div class="bg-white">
            <h3 class="text-xl font-bold text-primary my-0 py-0">Instructions </h3>
            <p class="text-gray-700 text-base leading-relaxed mb-4">For students and professionals before you begin your psychometric assessment:</p>
        </div>

        <!-- Modal Body -->
        <div>
            <p class="text-gray-900 font-bold text-base leading-relaxed mb-1">
               1. Manage Your Time Well
            </p>
            <p class="text-gray-700 font-medium text-base leading-relaxed mb-4">
                The assessment has a fixed time limit, so read each question carefully and respond promptly
            </p>
            <p class="text-gray-900 font-bold text-base leading-relaxed mb-1">
               2. No Skipping Questions
            </p>
            <p class="text-gray-700 font-medium text-base leading-relaxed mb-4">
                Every question must be answered to complete the assessment, so stay focused from start to finish
            </p>
            <p class="text-gray-900 font-bold text-base leading-relaxed mb-1">
               3. Answer Naturally and Honestly
            </p>
            <p class="text-gray-700 font-medium text-base leading-relaxed mb-4">
                Choose responses that truly reflect your thoughts, preferences, and behavior. There are no right or wrong answers
            </p>
            <p class="text-gray-900 font-bold text-base leading-relaxed mb-1">
               4. Stay Calm and Relax
            </p>
            <p class="text-gray-700 font-medium text-base leading-relaxed mb-4">
                Don’t panic while answering. The assessment is designed to understand you better, not to test you like an exam
            </p>
            <p class="text-gray-900 font-bold text-base leading-relaxed mb-1">
               5. Do Your Best
            </p>
            <p class="text-gray-700 font-medium text-base leading-relaxed mb-4">
                Give answers to the best of your ability and concentration so the results accurately represent your strengths and potential.
            </p>
        </div>

        <!-- Modal Footer -->
        <div class="bg-gray-50 px-6 py-4 flex gap-3 justify-end">
            <button 
                class="px-6 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 font-semibold hover:bg-gray-100 transition-colors duration-200">
                Cancel
            </button>
            <button @click="showInstructionModal = false;" class="px-6 py-2.5 rounded-lg bg-linear-to-r from-green-600 to-green-700 text-white font-semibold hover:from-green-700 hover:to-green-800 shadow-lg hover:shadow-xl transition-all duration-200">
                Start Test
            </button>
        </div>
    </div>
</div>
