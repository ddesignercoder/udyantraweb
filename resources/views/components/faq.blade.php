{{-- Section 6: FAQ --}}
    
    <div class="max-w-3xl mx-auto px-4">
        <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
            Frequently asked questions
        </h2>
        
        {{-- FAQ Items --}}
        @php
            $faqs = [
                ['question' => 'How accurate are the tests?', 'answer' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
                ['question' => 'Are results confidential?', 'answer' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
                ['question' => 'How long does each test take?', 'answer' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book."],
            ];
        @endphp

        <div class="space-y-4" x-data="{ active: null }">
            @foreach($faqs as $faq)
                <div class="transition-all duration-300">
                    <button @click="active = (active === {{ $loop->index }} ? null : {{ $loop->index }})" class="w-full px-8 py-4 md:py-5 flex items-start justify-between text-left focus:outline-none cursor-pointer bg-lightgray rounded-4xl">
                        <span class="text-lg font-medium text-black">{{ $faq['question'] }}</span>
                        
                        <span class="ml-4 shrink-0 relative mt-1 w-5 h-5">
                            <svg x-show="active !== {{ $loop->index }}" class="w-5 h-5 text-black absolute inset-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                            <svg x-show="active === {{ $loop->index }}" x-cloak class="w-5 h-5 text-black absolute inset-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                        </span>
                    </button>
                    <div x-show="active === {{ $loop->index }}" x-collapse x-cloak class="px-8 pb-6 text-black text-base fw-normal mt-5 leading-relaxed">
                        {{ $faq['answer'] }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>