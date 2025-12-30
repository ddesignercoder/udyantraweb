{{-- Carousel Logic --}}
<div x-data="{ 
        scrollContainer() { return this.$refs.container },
        getScrollWidth() { return this.$refs.container.firstElementChild.getBoundingClientRect().width + 24 },
        scrollNext() { this.scrollContainer().scrollBy({ left: this.getScrollWidth(), behavior: 'smooth' }) },
        scrollPrev() { this.scrollContainer().scrollBy({ left: -this.getScrollWidth(), behavior: 'smooth' }) }
    }" class="relative">

    <div x-ref="container" class="flex gap-6 overflow-x-auto snap-x snap-mandatory pb-4 hide-scrollbar">
        @php
            $stories = [
                ['name' => 'Erin Booth', 'role' => 'Virtual Assistant Coach', 'img' => '5', 'title' => 'Get Full Control', 'quote' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley..."],
                ['name' => 'Razvan Ciobanu', 'role' => 'Voxyde', 'img' => '3', 'title' => 'Peace of Mind', 'quote' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley..."],
                ['name' => 'Dan George', 'role' => 'FlightInsight', 'img' => '11', 'title' => '10,000+ Students', 'quote' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley..."],
                ['name' => 'Rony Pinto', 'role' => 'Virtual Assistant Coach', 'img' => '5', 'title' => 'Get Full Control', 'quote' => 'Lorem Ipsum is simply dummy text of the printing and typesetting industry...'],
            ];
        @endphp

        @foreach($stories as $story)
            <div class="w-full md:w-[calc(50%-1rem)] lg:w-[calc(33.333%-1rem)] flex-none border border-lightgray rounded-xl p-6 snap-center flex flex-col bg-white">
                <div class="flex items-center mb-4">
                    <img src="https://i.pravatar.cc/150?img={{ $story['img'] }}" 
                        alt="{{ $story['name'] }}" 
                        class="w-12 h-12 rounded-full object-cover mr-3 bg-gray-100">
                    <div>
                        <h4 class="font-bold text-textBlack text-sm">{{ $story['name'] }}</h4>
                        <h5 class="text-xs text-black opacity-[0.7]">{{ $story['role'] }}</h5>
                    </div>
                </div>
                <h5 class="text-base font-bold text-textBlack mb-2">{{ $story['title'] }}</h5>
                <p class="text-black opacity-[0.7] text-sm leading-relaxed mb-6 grow line-clamp-4">"{{ $story['quote'] }}"</p>
                <a href="#" class="text-sm font-bold text-gray-900 hover:underline mt-auto flex items-center">
                    Explore school <span class="ml-1">&rarr;</span>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Controls --}}
    <div class="flex justify-center gap-4 mt-4 md:mt-8">
        <button @click="scrollPrev()" class="w-8 h-8 md:w-12 md:h-12 rounded-full bg-black text-white flex items-center justify-center cursor-pointer leading-none  hover:bg-gray-800 transition shadow-lg ">
            <span class="relative top-[-2px]">&larr;</span>
        </button>
        <button @click="scrollNext()" class="w-8 h-8 md:w-12 md:h-12 rounded-full bg-black text-white flex items-center justify-center cursor-pointer leading-none  hover:bg-gray-800 transition shadow-lg">
            <span class="relative top-[-2px]">&rarr;</span>
        </button>
    </div>
</div>