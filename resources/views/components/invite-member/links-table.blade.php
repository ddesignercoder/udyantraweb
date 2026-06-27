@props(['invitations'])

<div class="bg-white p-6 rounded-xl shadow-sm border border-primary-light max-w-4xl">
    <h3 class="text-primary text-lg font-semibold mb-4 flex items-center gap-2">
        <x-lucide-link-2 class="w-5 h-5" />
        Generated Invitation Links
    </h3>

    <div class="overflow-x-auto">
        <table class="w-full text-left text-sm text-gray-600">
            <thead class="bg-gray-50 text-gray-900 uppercase font-semibold text-xs border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4">Form Tag</th>
                    <th class="px-6 py-4">Invitation Link</th>
                    <th class="px-6 py-4">Created On</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <template x-for="invite in invitations" :key="invite.hash_key">
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 font-medium text-gray-900" x-text="invite.form_tag"></td>
                        <td class="px-6 py-4 font-mono text-xs text-primary break-all" x-text="getRegisterUrl(invite.hash_key)"></td>
                        <td class="px-6 py-4" x-text="formatDate(invite.created_at)"></td>
                        <td class="px-6 py-4">
                            <div class="flex items-center gap-2">
                                <button @click="toggleLinkStatus(invite.id, invite)"
                                    :disabled="invite.toggling"
                                    class="relative inline-flex h-5 w-9 shrink-0 cursor-pointer rounded-full border-2 border-transparent transition-colors duration-200 ease-in-out focus:outline-none disabled:opacity-50 disabled:cursor-not-allowed"
                                    :class="invite.is_active ? 'bg-primary' : 'bg-gray-200'">
                                    <span class="sr-only">Toggle Status</span>
                                    <span aria-hidden="true" 
                                        class="pointer-events-none inline-block h-4 w-4 transform rounded-full bg-white shadow ring-0 transition duration-200 ease-in-out"
                                        :class="invite.is_active ? 'translate-x-4' : 'translate-x-0'">
                                    </span>
                                </button>
                                <span class="text-xs font-semibold"
                                    :class="invite.is_active ? 'text-green-800' : 'text-black'"
                                    x-text="invite.toggling ? 'Updating...' : (invite.is_active ? 'Active' : 'Inactive')">
                                </span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <div class="flex items-center justify-end gap-2">
                                <a :href="'{{ route('dashboard.invite.users') }}?form_tag=' + encodeURIComponent(invite.form_tag)" 
                                   class="inline-flex items-center gap-1 bg-white hover:bg-gray-100 text-primary border border-secondary px-3 py-1.5 rounded-full text-xs font-semibold cursor-pointer transition">
                                    <x-lucide-users class="w-3.5 h-3.5" />
                                    <span>Users</span>
                                </a>
                                <button @click="copyExistingLink(getRegisterUrl(invite.hash_key), invite)" 
                                    :disabled="invite.copied"
                                    class="inline-flex items-center gap-1 bg-white hover:bg-gray-100 text-primary border border-secondary px-3 py-1.5 rounded-full text-xs font-semibold cursor-pointer transition disabled:opacity-50">
                                    <x-lucide-copy class="w-3.5 h-3.5" />
                                    <span x-text="invite.copied ? 'Copied!' : 'Copy'"></span>
                                </button>
                            </div>
                        </td>
                    </tr>
                </template>
                <template x-if="invitations.length === 0">
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-400">
                            No invitation links generated yet.
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>

    <!-- Server-side Pagination Footer -->
    @if($invitations && $invitations->hasPages())
        <div class="mt-6 border-t border-gray-100 pt-6">
            {{ $invitations->withQueryString()->links('components.notes.notes-pagenation') }}
        </div>
    @endif
</div>
