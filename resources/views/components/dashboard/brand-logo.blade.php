@props(['data'])

<div class="bg-white shadow sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-base font-semibold leading-6 text-gray-900">Update Brand Logo</h3>
        <div class="mt-2 max-w-xl text-sm text-gray-500">
            <p>Please upload Transparent Background Logo. <br>Allowed formats: JPG, PNG, WebP. Max size: 250KB.</p>
        </div>

        @if(!empty($data['organization']['brand_logo_url']))
        <div class="mt-6 mb-4">
            <h4 class="text-sm font-medium text-gray-700 mb-2">Current Logo</h4>
            <div class="relative h-32 w-32 rounded-lg border border-gray-200 overflow-hidden bg-gray-50 flex items-center justify-center">
                <img src="{{ asset('udyantra-storage/' . $data['organization']['brand_logo_url']) }}" alt="Current Brand Logo" class="max-h-full max-w-full object-contain">
            </div>
        </div>
        @endif

        <form action="{{ route('brand-logo.update') }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-6">
            @csrf

            <!-- Form Group -->
            <div>
                <label for="brand_logo" class="block text-sm font-medium leading-6 text-gray-900">
                    Logo Image
                </label>
                <div class="mt-2 flex items-center gap-x-3">
                    <input type="file" 
                           id="brand_logo" 
                           name="brand_logo" 
                           accept=".jpg,.jpeg,.png,.webp"
                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-primary file:text-white hover:file:bg-primary/90 focus:outline-none" 
                           required>
                </div>
                
                @error('brand_logo', 'updateBrandLogo')
                    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end gap-x-3">
                <button type="submit" class="cursor-pointer rounded-md bg-primary px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-primary/90 focus-visible:outline  focus-visible:outline-offset-2 focus-visible:outline-primary">
                    Upload Logo
                </button>
            </div>
        </form>
    </div>
</div>
