@extends('layouts.dashboard')

@section('title', 'Invite Members')

@section('content')

    <div class="mb-8">
        <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">Invite Members to Self-Register</h1>
        <p class="text-textBlack text-lg md:text-xl leading-tight">Generate and copy the registration link for your organization.</p>
    </div>

    <div class="bg-white p-6 rounded-xl shadow-sm border border-primary-light max-w-2xl">
        <h3 class="text-primary text-lg font-semibold mb-4 flex items-center gap-2">
            <x-lucide-share-2 class="w-5 h-5" />
            Invite Members
        </h3>
        <p class="text-textBlack mb-6 text-sm">
            Fill in the fields below to dynamically generate and copy a unique self-registration link for your 
            <strong>{{ $role === 'school_admin' ? 'students' : 'employees' }}</strong>.
        </p>

        <!-- Inputs Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <div>
                <label for="custom_source" class="block text-sm font-medium text-gray-700 mb-1.5">UTM parameter(Optional)</label>
                <input type="text" id="custom_source" placeholder="e.g. meta, google, whatsapp..." class="border border-secondary rounded-full px-4 py-2 text-sm text-textBlack focus:outline-none focus:ring-2 focus:ring-primary bg-white w-full">
            </div>
            <div>
                <label for="custom_tag" class="block text-sm font-medium text-gray-700 mb-1.5">Form Tag <span class="text-red-500">*</span></label>
                <input type="text" id="custom_tag" placeholder="e.g. Batch-A, Morning-Class..." class="border border-secondary rounded-full px-4 py-2 text-sm text-textBlack focus:outline-none focus:ring-2 focus:ring-primary bg-white w-full" required>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-2 pt-6 border-t border-gray-100">
            <input type="text" readonly id="invite_link" 
                placeholder="Fill in the fields above and click 'Generate & Copy Link'..." 
                class="w-full bg-lightgray px-4 py-2 border border-secondary rounded-full text-sm text-textBlack focus:outline-none">
            <button id="action_btn" onclick="generateAndCopyLink()" 
                class="bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-full font-semibold transition cursor-pointer text-sm shrink-0">
                Generate & Copy Link
            </button>
        </div>
    </div>

@section('scripts')
    <script>
    async function generateAndCopyLink() {
        const customTagInput = document.getElementById('custom_tag');
        const formTag = customTagInput.value.trim();

        if (!formTag) {
            Swal.fire({
                icon: 'error',
                title: 'Required Field',
                text: 'Please enter a Form Tag to generate a link.'
            });
            return;
        }

        // Clean value
        const cleanTag = formTag.replace(/[^a-z0-9_-]/gi, '');

        // Show loading state
        const btn = document.getElementById('action_btn');
        const originalText = btn.innerText;
        btn.innerText = 'Generating...';
        btn.disabled = true;

        try {
            const response = await fetch("{{ route('dashboard.invite.generate') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    form_tag: cleanTag
                })
            });

            const data = await response.json();

            btn.innerText = originalText;
            btn.disabled = false;

            if (data.status) {
                const hashKey = data.data.hash_key;
                
                // Construct the link
                const customSourceInput = document.getElementById('custom_source');
                const sourceValue = customSourceInput.value.trim();
                let registerUrl = "{{ route('register.member.view', ['inviteCode' => ':hash:']) }}";
                registerUrl = registerUrl.replace(':hash:', hashKey);
                
                let finalUrl = registerUrl;
                if (sourceValue) {
                    const cleanSource = encodeURIComponent(sourceValue.toLowerCase().replace(/[^a-z0-9_-]/g, ''));
                    finalUrl = `${registerUrl}?trackingparam=${cleanSource}`;
                }

                // Update input text
                const inviteLinkInput = document.getElementById('invite_link');
                inviteLinkInput.value = finalUrl;

                // Copy to clipboard
                inviteLinkInput.select();
                inviteLinkInput.setSelectionRange(0, 99999);
                await navigator.clipboard.writeText(finalUrl);

                Toast.fire({
                    icon: 'success',
                    title: 'Invite link generated & copied!'
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: data.message || 'Failed to generate link.'
                });
            }
        } catch (error) {
            btn.innerText = originalText;
            btn.disabled = false;
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Something went wrong. Please try again.'
            });
        }
    }
    </script>
@endsection

@endsection
