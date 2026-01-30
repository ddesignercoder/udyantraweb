<!-- Submit Loader Component -->
<div x-show="isSubmitting" 
    x-transition.opacity.duration.300ms
    class="fixed inset-0 z-100 bg-white/90 backdrop-blur-sm flex flex-col items-center justify-center"
    style="display: none;">
    
    <div class="relative w-16 h-16 mb-4">
        <div class="absolute inset-0 rounded-full border-4 border-primary-light/30"></div>
        <div class="absolute inset-0 rounded-full border-4 border-t-transparent border-primary animate-spin"></div>
    </div>

    <h3 class="text-xl font-bold text-primary font-sans tracking-tight">
        Submitting Test
    </h3>
    <p class="text-black font-sans text-sm mt-1 animate-pulse">
        Please do not close this window...
    </p>
</div>
