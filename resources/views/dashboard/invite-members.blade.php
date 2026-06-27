@extends('layouts.dashboard')

@section('title', 'Invite Members')

@section('content')

    <div x-data="inviteMembersPage({{ json_encode($invitations ? $invitations->items() : []) }}, '{{ $role }}')" class="space-y-8">
        
        <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">Invite Members to Self-Register</h1>
            {{--<p class="text-textBlack text-lg md:text-xl leading-tight">Generate and copy the registration link for your organization.</p>
        --}}

        <x-invite-member.generate-form :role="$role" />

        <x-invite-member.links-table :invitations="$invitations" />

    </div>

@section('scripts')
    <script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('inviteMembersPage', (initialInvitations, role) => ({
            role: role,
            customSource: '',
            customTag: '',
            inviteLink: '',
            generating: false,
            invitations: initialInvitations.map(inv => ({ ...inv, copied: false, toggling: false })),

            async generateAndCopyLink() {
                const formTag = this.customTag.trim();
                if (!formTag) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Required Field',
                        text: 'Please enter a Form Tag to generate a link.'
                    });
                    return;
                }

                const cleanTag = formTag.replace(/[^a-z0-9_-]/gi, '');
                this.generating = true;

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
                    this.generating = false;

                    if (data.status) {
                        const hashKey = data.data.hash_key;
                        
                        let registerUrl = "{{ route('register.member.view', ['inviteCode' => ':hash:']) }}";
                        registerUrl = registerUrl.replace(':hash:', hashKey);
                        
                        let finalUrl = registerUrl;
                        if (this.customSource.trim()) {
                            const cleanSource = encodeURIComponent(this.customSource.trim().toLowerCase().replace(/[^a-z0-9_-]/g, ''));
                            finalUrl = `${registerUrl}?trackingparam=${cleanSource}`;
                        }

                        this.inviteLink = finalUrl;

                        // Copy to clipboard
                        await navigator.clipboard.writeText(finalUrl);

                        // Add new invitation at the beginning of the list
                        const newInvite = {
                            id: data.data.id,
                            form_tag: cleanTag,
                            hash_key: hashKey,
                            created_at: new Date().toISOString(),
                            is_active: true,
                            copied: false,
                            toggling: false
                        };
                        this.invitations.unshift(newInvite);

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
                    this.generating = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            },

            async copyExistingLink(url, invite) {
                await navigator.clipboard.writeText(url);
                invite.copied = true;
                Toast.fire({
                    icon: 'success',
                    title: 'Link copied to clipboard!'
                });
                setTimeout(() => {
                    invite.copied = false;
                }, 2000);
            },

            async toggleLinkStatus(id, invite) {
                if (invite.toggling) return;
                
                invite.toggling = true;

                try {
                    let url = "{{ route('dashboard.invite.toggle-status', ['id' => ':id:']) }}";
                    url = url.replace(':id:', id);

                    const response = await fetch(url, {
                        method: 'PATCH',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    });

                    const data = await response.json();
                    invite.toggling = false;

                    if (data.status) {
                        invite.is_active = data.data.is_active;
                        Toast.fire({
                            icon: 'success',
                            title: `Link has been ${invite.is_active ? 'activated' : 'deactivated'}.`
                        });
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.message || 'Failed to update status.'
                        });
                    }
                } catch (error) {
                    invite.toggling = false;
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            },

            formatDate(dateString) {
                const date = new Date(dateString);
                const options = { day: '2-digit', month: 'short', year: 'numeric' };
                return date.toLocaleDateString('en-GB', options).replace(/ /g, ' ');
            },

            getRegisterUrl(hashKey) {
                let registerUrl = "{{ route('register.member.view', ['inviteCode' => ':hash:']) }}";
                return registerUrl.replace(':hash:', hashKey);
            }
        }));
    });
    </script>
@endsection

@endsection
