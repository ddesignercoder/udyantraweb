@props(['data'])

<div class="bg-white shadow sm:rounded-lg" x-data="{ previewUrl: null }">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Update Brand Background</h3>
        <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>Please upload a landscape image. <br>Allowed formats: JPG, PNG, WebP. Max size: 2MB.</p>
        </div>

        <!-- Live Selection Preview or Current Background -->
        <div class="mt-6 mb-4">
            <template x-if="previewUrl">
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Selected Preview</h4>
                    <div class="relative max-w-lg rounded-lg border border-gray-200 overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img :src="previewUrl" alt="Selected Brand Background" class="w-full object-cover aspect-video">
                    </div>
                </div>
            </template>
            <template x-if="!previewUrl && '{{ !empty($data['organization']['brand_background_url']) }}'">
                <div>
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Current Background</h4>
                    <div class="relative max-w-lg rounded-lg border border-gray-200 overflow-hidden bg-gray-50 flex items-center justify-center">
                        <img src="{{ asset('udyantra-storage/' . ($data['organization']['brand_background_url'] ?? '')) }}" alt="Current Brand Background" class="w-full object-cover aspect-video">
                    </div>
                </div>
            </template>
        </div>

        <form action="{{ route('brand-background.update') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-6">
            @csrf

            <!-- Form Group -->
            <div>
                <label for="brand_background" class="block text-sm font-medium leading-6 text-gray-900">
                    Background Image
                </label>
                <div class="mt-2 flex items-center gap-x-3">
                    <input type="file" 
                           id="brand_background" 
                           name="brand_background" 
                           accept=".jpg,.jpeg,.png,.webp"
                           @change="previewUrl = URL.createObjectURL($event.target.files[0])"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90 focus:outline-none" 
                           required>
                </div>
                
                @error('brand_background', 'updateBrandBackground')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-x-3">
                <button type="submit" class="cursor-pointer rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 focus-visible:outline  focus-visible:outline-offset-2 focus-visible:outline-primary">
                    Upload Background
                </button>
            </div>
        </form>
    </div>
</div>
