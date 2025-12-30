@extends('layouts.testpanel')
@section('title', 'Test Panel')

@section('css')
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 4px; } /* Thinner for mobile */
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

        .shape-polygon { 
            clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 50% 100%, 0% 85%);
        }
        
        /* Smooth slide transition for mobile drawer */
        .drawer-enter-active, .drawer-leave-active { transition: transform 0.3s ease-in-out; }
        .drawer-enter-start, .drawer-leave-end { transform: translateX(100%); }
    </style>
@endsection

@section('content')
<div class="h-screen flex flex-col bg-gray-100 font-sans overflow-hidden"
     x-data="testPanel({{ Js::from($questions) }}, {{ Js::from($test) }}, {{ Js::from(session('user_id')) }})">

    {{-- TOP HEADER (Sticky) --}}
    <header class="bg-white shadow-sm border-b-4 border-blue-600 z-30 shrink-0">
        <div class="max-w-7xl mx-auto px-4 py-2 flex justify-between items-center">
            
            {{-- Title --}}
            <div class="truncate mr-2">
                <h1 class="text-sm md:text-lg font-bold text-gray-800 uppercase truncate" x-text="test.name"></h1>
                <div class="text-xs text-gray-500 font-mono lg:hidden">
                   Q.<span x-text="currentIndex + 1"></span> / <span x-text="questions.length"></span>
                </div>
            </div>

            {{-- Right Side: Timer & Palette Toggle --}}
            <div class="flex items-center gap-2 md:gap-4">
                {{-- Timer --}}
                <div class="flex flex-col items-end md:items-center">
                    <span class="text-[10px] text-gray-500 font-bold uppercase hidden md:block">Time Left</span>
                    <div class="text-base md:text-xl font-mono font-bold px-2 py-0.5 md:px-3 md:py-1 rounded bg-black text-white"
                         :class="{'bg-red-600': timeLeft < 300}">
                        <span x-text="formatTime(timeLeft)"></span>
                    </div>
                </div>

                {{-- Mobile Palette Toggle Button --}}
                <button @click="showPalette = !showPalette" 
                        class="lg:hidden p-2 text-gray-600 hover:bg-gray-100 rounded border border-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>
    </header>

    {{-- MAIN CONTENT AREA --}}
    <div class="grow relative max-w-7xl mx-auto w-full grid grid-cols-1 lg:grid-cols-4 gap-4 lg:p-4 overflow-hidden">

        {{-- LEFT COLUMN: Question Area --}}
        <main class="lg:col-span-3 flex flex-col h-full bg-white lg:rounded shadow-sm overflow-hidden relative">
            
            {{-- Question Header --}}
            <div class="bg-blue-50 px-4 py-2 border-b border-blue-100 flex justify-between items-center shrink-0">
                <span class="font-bold text-blue-900 text-base md:text-lg">
                    Question <span x-text="currentIndex + 1"></span>
                </span>
                <span class="text-[10px] md:text-xs font-bold px-2 py-1 rounded bg-white border border-blue-200 text-blue-800 uppercase" 
                      x-text="currentQuestion.section ?? 'General'"></span>
            </div>
            <div class="lg:hidden flex justify-center">
                <button @click="submitTest()" class="w-full py-2 px-4  bg-blue-800 text-white font-bold  shadow hover:bg-blue-900 transition text-sm">
                    SUBMIT TEST
                </button>
            </div>

            {{-- Scrollable Question Body --}}
            <div class="p-4 md:p-6 grow overflow-y-auto custom-scrollbar pb-24 lg:pb-6">
                {{-- Question Text --}}
                <div class="text-base md:text-lg text-gray-900 font-medium mb-6 border-b pb-4 leading-relaxed">
                    <span x-html="currentQuestion.question_text"></span>
                </div>

                {{-- Options --}}
                <div class="space-y-3 mb-2 md:mb-4">
                    <template x-for="optionKey in ['a', 'b', 'c', 'd', 'e']" :key="optionKey">
                        <div x-show="currentQuestion['option_' + optionKey]"
                             @click="selectOption(optionKey)"
                             class="flex items-start p-3 md:p-4 cursor-pointer border rounded-lg hover:bg-gray-50 transition-colors touch-manipulation select-none"
                             :class="answers[currentQuestion.id] === optionKey 
                                ? 'border-blue-500 bg-blue-50 ring-1 ring-blue-500' 
                                : 'border-gray-200'">
                            
                            <div class="mt-0.5 w-5 h-5 md:w-6 md:h-6 rounded-full border shrink-0 flex items-center justify-center mr-3"
                                 :class="answers[currentQuestion.id] === optionKey 
                                    ? 'border-blue-600 bg-blue-600' 
                                    : 'border-gray-400'">
                                <div class="w-2 h-2 md:w-2.5 md:h-2.5 bg-white rounded-full" x-show="answers[currentQuestion.id] === optionKey"></div>
                            </div>

                            <div class="text-gray-800 text-sm md:text-base">
                                <strong class="uppercase mr-1 text-gray-500" x-text="optionKey + '.'"></strong>
                                <span x-text="currentQuestion['option_' + optionKey]"></span>
                            </div>
                        </div>
                    </template>
                </div>

                {{-- Secondary Actions (Review/Clear) --}}
                <div class="flex justify-between items-center mt-4 md:mt-2 pt-2 md:pt-2 border-t border-gray-100">
                     <button @click="markForReview()" 
                             class="cursor-pointer text-xs md:text-sm font-medium px-3 py-2 rounded text-purple-700 bg-purple-50 border border-purple-200 hover:bg-purple-100 transition">
                         <span x-text="marked[currentQuestion.id] ? 'Unmark Review' : 'Mark for Review'"></span>
                     </button>

                     <button @click="clearResponse()" x-show="answers[currentQuestion.id]"
                             class="cursor-pointer text-xs md:text-sm px-3 py-2 rounded text-gray-500 bg-purple-50 border border-purple-200 hover:text-red-600 hover:bg-red-50 transition ">
                        Clear Selection
                    </button>
                </div>
            </div>
            
            {{-- DESKTOP FOOTER (Hidden on Mobile) --}}
            <div class="hidden lg:flex bg-gray-50 px-4 py-3 border-t border-gray-200 justify-between items-center shrink-0">
                <button @click="prev()" :disabled="currentIndex === 0" class="cursor-pointer px-6 py-2 rounded bg-gray-200 text-gray-700 font-bold hover:bg-gray-300 disabled:opacity-50 text-sm">Previous</button>
                
                <div class="flex gap-2">
                    <button x-show="currentIndex < questions.length - 1" @click="saveAndNext()" class="cursor-pointer px-6 py-2 rounded bg-blue-600 text-white font-bold hover:bg-blue-700 text-sm shadow">Save & Next</button>
                    <button x-show="currentIndex === questions.length - 1" @click="submitTest()" class="cursor-pointer px-6 py-2 rounded bg-green-600 text-white font-bold hover:bg-green-700 text-sm shadow">Submit Test</button>
                </div>
            </div>

            {{-- MOBILE STICKY FOOTER (Fixed Bottom) --}}
            <div class="lg:hidden absolute bottom-0 left-0 w-full bg-white border-t border-gray-200 p-3 shadow-[0_-4px_6px_-1px_rgba(0,0,0,0.1)] flex gap-3 z-20">
                <button @click="prev()" :disabled="currentIndex === 0" 
                    class="flex-1 py-3 rounded-lg bg-gray-100 text-gray-700 font-bold text-sm disabled:opacity-50 border border-gray-300">
                    PREV
                </button>
                
                <button x-show="currentIndex < questions.length - 1" @click="saveAndNext()" 
                    class="flex-2 py-3 rounded-lg bg-blue-600 text-white font-bold text-sm shadow-md active:bg-blue-700">
                    NEXT
                </button>

                <button x-show="currentIndex === questions.length - 1" @click="submitTest()" 
                    class="flex-2 py-3 rounded-lg bg-green-600 text-white font-bold text-sm shadow-md animate-pulse">
                    SUBMIT
                </button>
            </div>
        </main>

        {{-- RIGHT COLUMN: Palette (Responsive Drawer) --}}
        {{-- Overlay for Mobile --}}
        <div x-show="showPalette" 
             x-transition.opacity 
             @click="showPalette = false"
             class="fixed inset-0 bg-white bg-opacity-90 z-40 lg:hidden"></div>

        {{-- The Palette Sidebar --}}
        <aside class="fixed inset-y-0 right-0 w-80 bg-white shadow-xl transform transition-transform duration-300 ease-in-out z-50 lg:translate-x-0 lg:static lg:w-auto lg:shadow-none lg:z-auto flex flex-col lg:h-full lg:bg-transparent"
               :class="showPalette ? 'translate-x-0' : 'translate-x-full lg:translate-x-0'">
            
            <div class="bg-white rounded shadow-sm border border-gray-200 flex flex-col h-full lg:h-auto max-h-screen">
                
                {{-- Drawer Header (Mobile Only) --}}
                <div class="p-4 border-b flex justify-between items-center lg:hidden bg-gray-50">
                    <h3 class="font-bold text-gray-700">Question Palette</h3>
                    <button @click="showPalette = false" class="text-gray-500 hover:text-gray-800">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>

                {{-- User Info --}}
                <div class="p-4 border-b flex items-center gap-3 bg-gray-50 lg:bg-white lg:rounded-t">
                    <div class="w-8 h-8 rounded-full bg-blue-100 flex items-center justify-center text-blue-600 font-bold text-xs">
                        {{ substr(session('user_name', 'Student'), 0, 1) }}
                    </div>
                    <div class="text-sm font-bold text-gray-800 truncate">{{ session('user_name', 'Student') }}</div>
                </div>

                {{-- Legend --}}
                <div class="p-4 border-b bg-white">
                    <div class="grid grid-cols-2 gap-y-2 text-[10px] md:text-xs text-gray-600">
                        <div class="flex items-center"><span class="w-4 h-4 bg-green-500 rounded mr-1"></span> Answered</div>
                        <div class="flex items-center"><span class="w-4 h-4 bg-red-500 rounded mr-1"></span> Not Ans</div>
                        <div class="flex items-center"><span class="w-4 h-4 bg-purple-600 rounded-full mr-1"></span> Review</div>
                        <div class="flex items-center"><span class="w-4 h-4 bg-gray-200 border border-gray-300 rounded mr-1"></span> Skipped</div>
                    </div>
                </div>

                {{-- Grid --}}
                <div class="p-4 overflow-y-auto custom-scrollbar grow lg:max-h-[400px]">
                    <h3 class="font-bold text-gray-800 mb-2 text-xs uppercase tracking-wide">Jump to Question</h3>
                    <div class="grid grid-cols-5 gap-2">
                        <template x-for="(q, index) in questions" :key="q.id">
                            <button @click="jumpTo(index); showPalette = false;"
                                    class="relative w-10 h-10 lg:w-9 lg:h-9 flex items-center justify-center text-sm lg:text-xs font-bold transition-all duration-150 shadow-sm"
                                    :class="getPaletteClass(q.id, index)">
                                <span x-text="index + 1"></span>
                                <span x-show="marked[q.id] && answers[q.id]" 
                                      class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full border border-white"></span>
                            </button>
                        </template>
                    </div>
                </div>

                {{-- Submit Button (Drawer Footer) --}}
                <div class="p-4 border-t bg-gray-50 lg:bg-white lg:rounded-b">
                    <button @click="submitTest()" class="w-full py-3 bg-blue-800 text-white font-bold rounded shadow hover:bg-blue-900 transition text-sm">
                        SUBMIT TEST
                    </button>
                </div>
            </div>
        </aside>

    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('testPanel', (questionsData, testData, userId) => ({
            questions: questionsData,
            test: testData,
            userId: userId,
            currentIndex: 0,
            showPalette: false, // New Mobile State
            
            // State Storage
            answers: {},
            visited: {},
            marked: {},
            
            timeLeft: (testData.duration_minutes * 60), 
            timerInterval: null,

            init() {
                const saved = localStorage.getItem('test_progress_' + this.test.id);
                if (saved) {
                    const data = JSON.parse(saved);
                    this.answers = data.answers || {};
                    this.marked = data.marked || {};
                    this.visited = data.visited || {};
                }
                this.visitCurrent();
                this.startTimer();
                window.onbeforeunload = () => "Are you sure? Progress might be lost.";
            },

            get currentQuestion() { return this.questions[this.currentIndex]; },

            visitCurrent() {
                if (!this.visited[this.currentQuestion.id]) {
                    this.visited[this.currentQuestion.id] = true;
                    this.saveProgress();
                }
            },

            selectOption(option) {
                this.answers[this.currentQuestion.id] = option;
                this.saveProgress();
            },

            clearResponse() {
                delete this.answers[this.currentQuestion.id];
                this.saveProgress();
            },

            markForReview() {
                if (this.marked[this.currentQuestion.id]) {
                    delete this.marked[this.currentQuestion.id];
                } else {
                    this.marked[this.currentQuestion.id] = true;
                }
                this.saveProgress();
            },

            saveAndNext() { this.next(); },

            next() {
                if (this.currentIndex < this.questions.length - 1) {
                    this.currentIndex++;
                    this.visitCurrent();
                    // Scroll to top of question area on mobile
                    document.querySelector('.custom-scrollbar').scrollTop = 0;
                }
            },

            prev() {
                if (this.currentIndex > 0) {
                    this.currentIndex--;
                    this.visitCurrent();
                }
            },

            jumpTo(index) {
                this.currentIndex = index;
                this.visitCurrent();
            },

            saveProgress() {
                localStorage.setItem('test_progress_' + this.test.id, JSON.stringify({
                    answers: this.answers,
                    marked: this.marked,
                    visited: this.visited
                }));
            },

            getPaletteClass(qId, index) {
                const isAnswered = this.answers[qId];
                const isMarked = this.marked[qId];
                const isVisited = this.visited[qId];
                const isCurrent = (this.currentIndex === index);

                let baseClass = "border ";

                if (isCurrent) baseClass += "ring-2 ring-black border-black z-10 ";
                else baseClass += "border-gray-300 ";

                if (isAnswered && isMarked) return baseClass + "bg-purple-600 text-white rounded-full";
                if (isAnswered) return baseClass + "bg-green-500 text-white rounded shape-polygon";
                if (isMarked) return baseClass + "bg-purple-600 text-white rounded-full";
                if (isVisited && !isAnswered) return baseClass + "bg-red-500 text-white rounded shape-polygon";

                return baseClass + "bg-gray-100 text-gray-700 rounded";
            },

            startTimer() {
                this.timerInterval = setInterval(() => {
                    if (this.timeLeft > 0) this.timeLeft--;
                    else this.finishTimer();
                }, 1000);
            },

            formatTime(seconds) {
                const h = Math.floor(seconds / 3600);
                const m = Math.floor((seconds % 3600) / 60);
                const s = seconds % 60;
                return `${h > 0 ? h + ':' : ''}${String(m).padStart(2,'0')}:${String(s).padStart(2,'0')}`;
            },

            finishTimer() {
                clearInterval(this.timerInterval);
                alert("Time Up!");
                this.submitTest();
            },
            
            async submitTest() {
                if (!confirm('Final Submit?')) return;
                clearInterval(this.timerInterval);
                window.onbeforeunload = null;

                const payload = {
                    test_id: this.test.id,
                    user_id: this.userId,
                    answers: this.answers,
                    time_taken: (this.test.duration_minutes * 60) - this.timeLeft
                };

                // Logic to submit (using axios as in your original code)
                try {
                    const response = await axios.post("{{ route('test.submit') }}", payload);
                    if (response.data.status) {
                        let url = "{{ route('test.result', ':id') }}";
                        window.location.href = url.replace(':id', response.data.result_id);
                    } else {
                        alert('Submission Failed: ' + (response.data.message || 'Error'));
                    }
                } catch (e) {
                    console.error(e);
                    alert('Network Error');
                }              
            }
        }));
    });
</script>
@endsection