@props(['role'])

<div class="bg-white p-6 rounded-xl shadow-sm border border-primary-light max-w-4xl">
    <h3 class="text-primary text-lg font-semibold mb-4 flex items-center gap-2">
        <x-lucide-share-2 class="w-5 h-5" />
        Invite Members
    </h3>
    <p class="text-textBlack mb-6 text-sm">
        Fill in the fields below to dynamically generate and copy a unique self-registration link for your 
        <strong>{{ $role === 'school_admin' ? 'students' : 'employees' }}</strong>.
    </p>

    <!-- Inputs Row -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-0 md:mb-6">
        <div>
            <label for="custom_source" class="block text-sm font-medium text-gray-700 mb-1.5">UTM parameter(Optional)</label>
            <input type="text" id="custom_source" x-model="customSource" placeholder="e.g. meta, google, whatsapp..." class="border border-secondary rounded-full px-4 py-2 text-sm text-textBlack focus:outline-none focus:ring-2 focus:ring-primary bg-white w-full">
        </div>
        <div>
            <label for="custom_tag" class="block text-sm font-medium text-gray-700 mb-1.5">Form Tag <span class="text-red-500">*</span></label>
            <input type="text" id="custom_tag" x-model="customTag" placeholder="e.g. Batch-A, Morning-Class..." class="border border-secondary rounded-full px-4 py-2 text-sm text-textBlack focus:outline-none focus:ring-2 focus:ring-primary bg-white w-full" required>
        </div>
    </div>

    <div class="flex flex-col sm:flex-row items-stretch sm:items-center  gap-8 md:gap-2 pt-6 border-t border-gray-100">
        <input type="text" readonly id="invite_link" :value="inviteLink"
            placeholder="Fill in the fields above and click 'Generate & Copy Link'..." 
            class="w-full bg-lightgray px-4 py-2 border border-secondary rounded-full text-sm text-textBlack focus:outline-none">
        <button id="action_btn" :disabled="generating" @click="generateAndCopyLink()"
            class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-full font-semibold transition cursor-pointer text-sm shrink-0 disabled:opacity-50 disabled:cursor-not-allowed">
            <span x-text="generating ? 'Generating...' : 'Generate & Copy Link'"></span>
        </button>
    </div>
</div>
