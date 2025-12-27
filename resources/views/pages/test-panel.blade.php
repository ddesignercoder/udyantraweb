@extends('layouts.testpanel')
@section('title', 'Test Panel')

@section('css')
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: #f1f1f1; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #9ca3af; }

        /* Custom Shapes for the Palette to match the image */
        .shape-box { border-radius: 4px; } /* Standard Square */
        .shape-circle { border-radius: 50%; } /* Circle */
        
        /* The "Tag" shape for Not Answered / Answered (optional, using plain colors is safer for text alignment) */
        .shape-polygon { 
            clip-path: polygon(0% 0%, 100% 0%, 100% 85%, 50% 100%, 0% 85%); /* Subtle point at bottom */
        }
    </style>
@endsection

@section('content')
<div class="min-h-screen bg-gray-100 py-2 font-sans"
     x-data="testPanel({{ Js::from($questions) }}, {{ Js::from($test) }}, {{ Js::from(session('user_id')) }})">

    {{-- TOP HEADER --}}
    <div class="max-w-7xl mx-auto px-4 mb-4">
        <div class="bg-white rounded shadow-sm p-3 flex justify-between items-center border-b-4 border-blue-600">
            <div>
                <h1 class="text-lg font-bold text-gray-800 uppercase" x-text="test.name"></h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="text-sm font-semibold text-gray-600">Time Left:</div>
                <div class="text-xl font-mono font-bold px-3 py-1 rounded bg-black text-white"
                     :class="{'bg-red-600': timeLeft < 300}">
                    <span x-text="formatTime(timeLeft)"></span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 grid grid-cols-1 lg:grid-cols-4 gap-4">

        {{-- LEFT COLUMN: Question Area --}}
        <div class="lg:col-span-3">
            <div class="bg-white rounded shadow-sm min-h-[500px] flex flex-col relative">
                
                {{-- Question Header --}}
                <div class="bg-blue-50 px-4 py-3 border-b border-blue-100 flex justify-between items-center">
                    <span class="font-bold text-blue-900 text-lg">
                        Q.<span x-text="currentIndex + 1"></span>
                    </span>
                    <span class="text-xs font-bold px-2 py-1 rounded bg-white border border-blue-200 text-blue-800 uppercase" 
                          x-text="currentQuestion.section ?? 'General'"></span>
                </div>

                {{-- Scrollable Content --}}
                <div class="p-6 grow overflow-y-auto">
                    {{-- Question Text --}}
                    <div class="text-lg text-gray-900 font-medium mb-6 border-b pb-4">
                        <span x-text="currentQuestion.question_text"></span>
                    </div>

                    {{-- Options --}}
                    <div class="space-y-3">
                        <template x-for="optionKey in ['a', 'b', 'c', 'd', 'e']" :key="optionKey">
                            <div x-show="currentQuestion['option_' + optionKey]"
                                 @click="selectOption(optionKey)"
                                 class="flex items-center p-3 cursor-pointer border rounded hover:bg-gray-50 transition-colors"
                                 :class="answers[currentQuestion.id] === optionKey 
                                    ? 'border-blue-500 bg-blue-50' 
                                    : 'border-gray-300'">
                                
                                <div class="w-5 h-5 rounded-full border flex items-center justify-center mr-3"
                                     :class="answers[currentQuestion.id] === optionKey 
                                        ? 'border-blue-600 bg-blue-600' 
                                        : 'border-gray-400'">
                                    <div class="w-2 h-2 bg-white rounded-full" x-show="answers[currentQuestion.id] === optionKey"></div>
                                </div>

                                <div class="text-gray-800 text-base">
                                    <strong class="uppercase mr-2" x-text="optionKey + '.'"></strong>
                                    <span x-text="currentQuestion['option_' + optionKey]"></span>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>

                {{-- Footer Buttons --}}
                <div class="bg-gray-50 px-4 py-3 border-t border-gray-200 flex flex-wrap justify-between items-center gap-2">
                    
                    {{-- Left Group --}}
                    <div class="flex gap-2">
                        <button @click="markForReview()" 
                                class="px-4 py-2 rounded border border-purple-600 text-purple-700 hover:bg-purple-50 font-medium text-sm transition">
                            Mark for Review
                        </button>
                        <button @click="clearResponse()" 
                                class="px-4 py-2 rounded border border-gray-300 text-gray-600 hover:bg-gray-100 font-medium text-sm transition">
                            Clear Response
                        </button>
                    </div>

                    {{-- Right Group --}}
                    <div class="flex gap-2">
                        <button @click="prev()" :disabled="currentIndex === 0"
                                class="px-6 py-2 rounded bg-gray-200 text-gray-700 font-bold hover:bg-gray-300 disabled:opacity-50 text-sm">
                            Previous
                        </button>
                        
                        <button x-show="currentIndex < questions.length - 1" 
                                @click="saveAndNext()"
                                class="px-6 py-2 rounded bg-blue-600 text-white font-bold hover:bg-blue-700 text-sm shadow">
                            Save & Next
                        </button>

                        <button x-show="currentIndex === questions.length - 1" 
                                @click="submitTest()"
                                class="px-6 py-2 rounded bg-green-600 text-white font-bold hover:bg-green-700 text-sm shadow animate-pulse">
                            Submit Test
                        </button>
                    </div>
                </div>
            </div>
        </div>

        {{-- RIGHT COLUMN: Palette --}}
        <div class="lg:col-span-1">
            <div class="bg-white rounded shadow-sm border border-gray-200 p-4 sticky top-4">
                
                {{-- User Profile / Info (Optional) --}}
                <div class="flex items-center gap-3 mb-4 border-b pb-2">
                    <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center text-gray-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                    </div>
                    <div>
                        <div class="text-sm font-bold text-gray-800">{{ session('user_name', 'Student') }}</div>
                    </div>
                </div>

                {{-- LEGEND --}}
                <div class="grid grid-cols-2 gap-y-3 gap-x-1 mb-4 text-xs text-gray-600">
                    <div class="flex items-center"><span class="w-6 h-6 flex items-center justify-center bg-gray-100 border border-gray-300 rounded mr-2 text-gray-700 font-bold">44</span> Not Visited</div>
                    <div class="flex items-center"><span class="w-6 h-6 flex items-center justify-center bg-red-500 rounded text-white font-bold mr-2" style="clip-path: polygon(0 0, 100% 0, 100% 80%, 50% 100%, 0 80%);">1</span> Not Answered</div>
                    <div class="flex items-center"><span class="w-6 h-6 flex items-center justify-center bg-green-500 rounded text-white font-bold mr-2" style="clip-path: polygon(0 0, 100% 0, 100% 80%, 50% 100%, 0 80%);">0</span> Answered</div>
                    <div class="flex items-center"><span class="w-6 h-6 flex items-center justify-center bg-purple-600 rounded-full text-white font-bold mr-2">0</span> Marked for Review</div>
                    <div class="flex items-center col-span-2">
                        <div class="relative w-6 h-6 mr-2">
                            <span class="absolute inset-0 bg-purple-600 rounded-full flex items-center justify-center text-white font-bold">0</span>
                            <span class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full border border-white"></span>
                        </div>
                        Ans & Marked for Review
                    </div>
                </div>

                {{-- Question Palette Grid --}}
                <h3 class="font-bold text-gray-800 mb-2 bg-blue-50 p-2 text-sm border-l-4 border-blue-500">Question Palette</h3>
                
                <div class="grid grid-cols-5 gap-2 max-h-[250px] overflow-y-auto pr-1 custom-scrollbar pb-2">
                    <template x-for="(q, index) in questions" :key="q.id">
                        <button @click="jumpTo(index)"
                                class="relative w-9 h-9 flex items-center justify-center text-xs font-bold transition-all duration-150"
                                :class="getPaletteClass(q.id, index)">
                            
                            <span x-text="index + 1"></span>
                            
                            {{-- Small Green Dot for 'Answered & Marked' --}}
                            <span x-show="marked[q.id] && answers[q.id]" 
                                  class="absolute bottom-0 right-0 w-2.5 h-2.5 bg-green-500 rounded-full border border-white"></span>
                        </button>
                    </template>
                </div>

                <div class="mt-4 pt-4 border-t border-gray-200">
                    <button @click="submitTest()" class="w-full py-2 bg-blue-800 text-white font-bold rounded hover:bg-blue-900 transition text-sm shadow">
                        SUBMIT TEST
                    </button>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('testPanel', (questionsData, testData, userId) => ({
            questions: questionsData,
            test: testData,
            userId: userId,
            currentIndex: 0,
            
            // State Storage
            answers: {},        // { question_id: 'a' }
            visited: {},        // { question_id: true }
            marked: {},         // { question_id: true }
            
            timeLeft: (testData.duration_minutes * 60), 
            timerInterval: null,

            init() {
                // Restore State
                const saved = localStorage.getItem('test_progress_' + this.test.id);
                if (saved) {
                    const data = JSON.parse(saved);
                    this.answers = data.answers || {};
                    this.marked = data.marked || {};
                    this.visited = data.visited || {};
                }

                // Mark first question as visited
                this.visitCurrent();
                this.startTimer();
                
                window.onbeforeunload = () => "Are you sure? Progress might be lost.";
            },

            get currentQuestion() {
                return this.questions[this.currentIndex];
            },

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
                // Toggle mark
                if (this.marked[this.currentQuestion.id]) {
                    delete this.marked[this.currentQuestion.id];
                } else {
                    this.marked[this.currentQuestion.id] = true;
                }
                this.saveProgress();
                //Move to next question automatically
                this.next(); 
            },

            saveAndNext() {
                // 'Save & Next' logic is just next() because we save on click
                this.next();
            },

            next() {
                if (this.currentIndex < this.questions.length - 1) {
                    this.currentIndex++;
                    this.visitCurrent();
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

            // --- PALETTE LOGIC (The Core UI Logic) ---
            getPaletteClass(qId, index) {
                const isAnswered = this.answers[qId];
                const isMarked = this.marked[qId];
                const isVisited = this.visited[qId];
                const isCurrent = (this.currentIndex === index);

                // Priority 1: Current Question (Optional: can just be a border, or distinct color)
                // If you want "Current" to override everything visually (like a blue border):
                let baseClass = "border ";

                if (isCurrent) {
                    baseClass += "ring-2 ring-black border-black z-10 ";
                } else {
                    baseClass += "border-gray-300 ";
                }

                // Priority 2: Marked & Answered
                if (isAnswered && isMarked) {
                    return baseClass + "bg-purple-600 text-white rounded-full";
                }

                // Priority 3: Answered (Green Polygon/Tag)
                if (isAnswered) {
                    return baseClass + "bg-green-500 text-white rounded shape-polygon";
                }

                // Priority 4: Marked (Purple Circle)
                if (isMarked) {
                    return baseClass + "bg-purple-600 text-white rounded-full";
                }

                // Priority 5: Not Answered but Visited (Red Polygon/Tag)
                if (isVisited && !isAnswered) {
                    return baseClass + "bg-red-500 text-white rounded shape-polygon";
                }

                // Priority 6: Not Visited (Gray Square)
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
                
                // Clear Interval & warning
                clearInterval(this.timerInterval);
                window.onbeforeunload = null;

                const payload = {
                    test_id: this.test.id,
                    user_id: this.userId,
                    answers: this.answers,
                    time_taken: (this.test.duration_minutes * 60) - this.timeLeft
                };
                
                console.log("Submitting:", payload);
                localStorage.removeItem('test_progress_' + this.test.id);

                try {
                    // 1. Post to your FRONTEND route
                    const response = await axios.post("{{ route('test.submit') }}", payload);

                    // 2. Check Status and Redirect
                    if (response.data.status) {
                        // Success: Redirect to Result Page
                        // We use a placeholder ':id' and replace it with the actual ID
                        let url = "{{ route('test.result', ':id') }}";
                        url = url.replace(':id', response.data.result_id);
                        
                        
                        window.location.href = url;
                    } else {
                        // Logical Error from Backend (e.g. Validation failed)
                        alert('Submission Failed: ' + (response.data.message || 'Unknown error'));
                    }

                } catch (e) {
                    console.error(e);
                    alert('Network Error: Unable to submit test. Please check your connection.');
                }               
            }
            
        }));
    });
</script>
@endsection