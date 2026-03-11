{{-- Feedback Survey Modal - Auto opens on page load --}}
@php
    $isStudent = session('user_role') == 'student';

    $studentQuestions = [
        ['q' => 'q1', 'text' => 'How do you usually spend most of your day after school?', 'options' => [
            ['val' => 'A', 'label' => 'Finishing homework and revising'],
            ['val' => 'B', 'label' => 'Playing sports or being outdoors'],
            ['val' => 'C', 'label' => 'Watching videos, gaming, or scrolling social media'],
            ['val' => 'D', 'label' => 'Working on hobbies or creative activities'],
        ]],
        ['q' => 'q2', 'text' => 'Which activity do you enjoy doing the most in your free time?', 'options' => [
            ['val' => 'A', 'label' => 'Reading or learning something new'],
            ['val' => 'B', 'label' => 'Playing a sport or exercising'],
            ['val' => 'C', 'label' => 'Watching shows, reels, or gaming'],
            ['val' => 'D', 'label' => 'Creating things (art, music, building, writing)'],
        ]],
        ['q' => 'q3', 'text' => 'What type of sports do you like the most?', 'options' => [
            ['val' => 'A', 'label' => 'Team sports (cricket, football, basketball)'],
            ['val' => 'B', 'label' => 'Individual sports (badminton, swimming, athletics)'],
            ['val' => 'C', 'label' => 'Casual fun sports (cycling, skating, fitness)'],
            ['val' => 'D', 'label' => 'Indoor sports (chess, carrom, cards)'],
        ]],
        ['q' => 'q4', 'text' => 'What kind of digital content do you enjoy watching?', 'options' => [
            ['val' => 'A', 'label' => 'Educational or informative videos'],
            ['val' => 'B', 'label' => 'Sports matches or fitness content'],
            ['val' => 'C', 'label' => 'Entertainment (movies, series, comedy, reels)'],
            ['val' => 'D', 'label' => 'Creativity & skills (DIY, tech, art, music)'],
        ]],
        ['q' => 'q5', 'text' => 'Apart from studies and sports, do you have any other interests?', 'options' => [
            ['val' => 'A', 'label' => 'Creative (art, music, writing, design)'],
            ['val' => 'B', 'label' => 'Tech based (coding, gadgets, puzzles)'],
            ['val' => 'C', 'label' => 'Social activities (clubs, volunteering)'],
            ['val' => 'D', 'label' => 'Digital (making reels, content creation)'],
        ]],
        ['q' => 'q6', 'text' => 'Do you think about your future career options? If yes, how do you usually explore them?', 'options' => [
            ['val' => 'A', 'label' => 'I research online through videos or reels'],
            ['val' => 'B', 'label' => 'I talk to parents, teachers or people working in that field'],
            ['val' => 'C', 'label' => 'I attend workshops and related events locally'],
            ['val' => 'D', 'label' => "I don't think about it much yet"],
        ]],
    ];

    $professionalQuestions = [
        ['q' => 'q1', 'text' => 'What is your current career stage?', 'options' => [
            ['val' => 'A', 'label' => 'Early career – exploring direction'],
            ['val' => 'B', 'label' => 'Mid-career – want growth or switch'],
            ['val' => 'C', 'label' => 'Senior – aiming leadership roles'],
            ['val' => 'D', 'label' => 'Entrepreneur / Freelancer'],
        ]],
        ['q' => 'q2', 'text' => 'What is your biggest professional goal for the next 2–3 years?', 'options' => [
            ['val' => 'A', 'label' => 'Salary growth / promotion'],
            ['val' => 'B', 'label' => 'Career switch'],
            ['val' => 'C', 'label' => 'Start a business / side income'],
            ['val' => 'D', 'label' => 'Personal development & confidence'],
        ]],
        ['q' => 'q3', 'text' => 'Which skills do you feel you need to improve right now?', 'options' => [
            ['val' => 'A', 'label' => 'Communication & Public Speaking'],
            ['val' => 'B', 'label' => 'Leadership & Management'],
            ['val' => 'C', 'label' => 'Technical / Domain Skills'],
            ['val' => 'D', 'label' => 'Digital Skills (AI, Data, Marketing, etc.)'],
        ]],
        ['q' => 'q4', 'text' => 'Are you considering learning a new course in the next 6 months?', 'options' => [
            ['val' => 'A', 'label' => 'Yes, definitely'],
            ['val' => 'B', 'label' => 'Maybe'],
            ['val' => 'C', 'label' => 'Only if affordable'],
            ['val' => 'D', 'label' => 'Not sure'],
        ]],
        ['q' => 'q5', 'text' => 'Which learning format do you prefer?', 'options' => [
            ['val' => 'A', 'label' => 'Live online classes'],
            ['val' => 'B', 'label' => 'Self-paced online courses'],
            ['val' => 'C', 'label' => 'Offline workshops'],
            ['val' => 'D', 'label' => 'Mentorship / Coaching programs'],
        ]],
        ['q' => 'q6', 'text' => 'What hobbies or interests would you like to explore?', 'options' => [
            ['val' => 'A', 'label' => 'Creative (writing, music, art)'],
            ['val' => 'B', 'label' => 'Fitness & wellness'],
            ['val' => 'C', 'label' => 'Finance & investing'],
            ['val' => 'D', 'label' => 'Content creation / digital branding'],
        ]],
        ['q' => 'q7', 'text' => 'What is stopping you from upskilling?', 'options' => [
            ['val' => 'A', 'label' => 'Lack of time'],
            ['val' => 'B', 'label' => 'Lack of clarity'],
            ['val' => 'C', 'label' => 'Financial constraints'],
            ['val' => 'D', 'label' => 'Fear of failure / self-doubt'],
        ]],
        ['q' => 'q8', 'text' => 'Would you like personalized guidance to plan your growth roadmap?', 'options' => [
            ['val' => 'A', 'label' => 'Yes'],
            ['val' => 'B', 'label' => 'Maybe'],
            ['val' => 'C', 'label' => 'No'],
        ]],
    ];

    $questions = $isStudent ? $studentQuestions : $professionalQuestions;
    // Step 1 = basic details, steps 2..N+1 = questions, step N+2 = thank you
    $totalSteps = count($questions) + 2;
    $accentColor = 'teal'; // Project primary color #018580
@endphp

<div x-data="feedbackSurvey()" x-init="showModal = true" x-cloak>

    {{-- Backdrop --}}
    <div x-show="showModal"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="fixed inset-0 z-50 bg-black/60 backdrop-blur-sm flex items-end sm:items-center justify-center p-0 sm:p-4"
        style="display: none;">

        {{-- Modal Container --}}
        <div x-show="showModal"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90 translate-y-4"
            x-transition:enter-end="opacity-100 scale-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            class="bg-white rounded-t-2xl sm:rounded-2xl shadow-2xl w-full sm:max-w-2xl max-h-[95vh] sm:max-h-[90vh] flex flex-col overflow-hidden">


            {{-- ===== HEADER ===== --}}
            <div class="px-4 py-3 sm:px-6 sm:py-4 flex items-center justify-between shrink-0 border-b border-gray-100">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/image/Udyantra-logo.svg') }}" alt="Udyantra" class="h-8 sm:h-10 w-auto">
                    <div>
                        <h3 class="text-base sm:text-lg font-bold text-black">Quick Survey</h3>
                        <p class="text-black/70 text-xs hidden sm:block">Please fill this small survey before you leave</p>
                    </div>
                </div>
                <button @click="showModal = false" class="text-black/70 hover:text-black transition-colors cursor-pointer">
                    <x-lucide-x class="w-6 h-6" />
                </button>
            </div>

            {{-- ===== SCROLLABLE BODY ===== --}}
            <div class="overflow-y-auto flex-1 px-4 py-4 sm:px-6 sm:py-5 space-y-4 sm:space-y-5">

                {{-- Step indicator --}}
                <div class="flex items-center justify-center gap-1 mb-2">
                    <template x-for="i in totalSteps" :key="i">
                        <div class="h-1.5 rounded-full transition-all duration-300"
                            :class="i <= currentStep ? 'bg-primary w-8' : 'bg-primary w-4'"></div>
                    </template>
                </div>

                {{-- === Step 1: Basic Details === --}}
                <div x-show="currentStep === 1"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-4">
                    <h4 class="text-sm sm:text-base font-semibold text-gray-800 mb-3 sm:mb-4">Basic Details</h4>

                    {{-- Gender --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-black mb-2">Gender</label>
                        <div class="flex gap-3">
                            <template x-for="g in [{val:'M',label:'Male'},{val:'F',label:'Female'},{val:'O',label:'Other'}]" :key="g.val">
                                <button type="button" @click="formData.gender = g.val"
                                    class="flex-1 py-2 px-3 rounded-lg border-2 text-sm font-medium transition-all duration-200"
                                    :class="formData.gender === g.val
                                        ? 'border-{{ $accentColor }}-500 bg-{{ $accentColor }}-50 text-{{ $accentColor }}-700'
                                        : 'border-black bg-white text-black hover:border-primary'"
                                    x-text="g.label"></button>
                            </template>
                        </div>
                    </div>

                    {{-- Age --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-black mb-2">Age (years)</label>
                        <input type="number" x-model="formData.age" min="5" max="100" placeholder="Enter your age"
                            class="w-full px-4 py-2.5 border-2 border-black rounded-lg text-sm focus:border-{{ $accentColor }}-500 focus:ring-1 focus:ring-{{ $accentColor }}-500 outline-none transition-colors">
                    </div>

                    @if(!$isStudent)
                    {{-- Current Role --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-black mb-2">Current Role / Profession</label>
                        <input type="text" x-model="formData.current_role" placeholder="e.g. Software Developer, Teacher..."
                            class="w-full px-4 py-2.5 border-2 border-black rounded-lg text-sm focus:border-{{ $accentColor }}-500 focus:ring-1 focus:ring-{{ $accentColor }}-500 outline-none transition-colors">
                    </div>

                    {{-- Years of Experience --}}
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-black mb-2">Years of Experience</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-2">
                            <template x-for="opt in [{val:'A',label:'0–2 years'},{val:'B',label:'3–5 years'},{val:'C',label:'6–10 years'},{val:'D',label:'10+ years'}]" :key="opt.val">
                                <button type="button" @click="formData.experience = opt.val"
                                    class="py-2 px-3 rounded-lg border-2 text-sm font-medium transition-all duration-200 text-left"
                                    :class="formData.experience === opt.val
                                        ? 'border-{{ $accentColor }}-500 bg-{{ $accentColor }}-50 text-{{ $accentColor }}-700'
                                        : 'border-black bg-white text-black hover:border-primary'">
                                    <span class="font-bold mr-1" x-text="opt.val + '.'"></span>
                                    <span x-text="opt.label"></span>
                                </button>
                            </template>
                        </div>
                    </div>
                    @endif
                </div>

                @foreach($questions as $index => $question)
                <div x-show="currentStep === {{ $index + 2 }}"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 translate-x-4"
                    x-transition:enter-end="opacity-100 translate-x-0"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 translate-x-0"
                    x-transition:leave-end="opacity-0 -translate-x-4">
                    <div class="bg-{{ $accentColor }}-50 rounded-xl p-4 mb-4">
                        <p class="text-sm font-semibold text-{{ $accentColor }}-800">
                            <span class="inline-flex items-center justify-center w-6 h-6 rounded-full bg-{{ $accentColor }}-600 text-black text-xs font-bold mr-2">{{ $index + 1 }}</span>
                            {{ $question['text'] }}
                        </p>
                    </div>
                    <div class="space-y-2">
                        @foreach($question['options'] as $opt)
                        <button type="button" @click="formData.{{ $question['q'] }} = '{{ $opt['val'] }}'"
                            class="w-full text-left py-3 px-4 rounded-xl border-2 text-sm font-medium transition-all duration-200 flex items-center gap-3 cursor-pointer"
                            :class="formData.{{ $question['q'] }} === '{{ $opt['val'] }}'
                                ? 'border-{{ $accentColor }}-500 bg-{{ $accentColor }}-50 text-{{ $accentColor }}-700 shadow-sm'
                                : 'border-black bg-white text-black hover:border-primary hover:bg-gray-50'">
                            <span class="shrink-0 w-7 h-7 rounded-full border-2 flex items-center justify-center text-xs font-bold"
                                :class="formData.{{ $question['q'] }} === '{{ $opt['val'] }}'
                                    ? 'border-{{ $accentColor }}-500 bg-{{ $accentColor }}-500 text-black'
                                    : 'border-black text-black'">{{ $opt['val'] }}</span>
                            <span>{{ $opt['label'] }}</span>
                        </button>
                        @endforeach
                    </div>
                </div>
                @endforeach

                {{-- === Thank You Step === --}}
                <div x-show="currentStep === totalSteps"
                    x-transition:enter="transition ease-out duration-300"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-200"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95">
                    <div class="text-center py-4 sm:py-6">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <x-lucide-circle-check class="w-8 h-8 text-green-600" />
                        </div>
                        <h4 class="text-xl font-bold text-gray-800 mb-2">Thank You!</h4>
                        <p class="text-gray-500 text-sm" x-text="responseMessage || 'Your survey response has been submitted successfully.'"></p>
                    </div>
                </div>

            </div>

            {{-- ===== FOOTER ===== --}}
            <div class="border-t border-gray-100 px-4 py-3 sm:px-6 sm:py-4 flex items-center justify-between shrink-0 bg-gray-50/80">
                <button @click="prevStep()"
                    x-show="currentStep > 1 && currentStep < totalSteps"
                    class="px-4 py-2 sm:px-5 sm:py-2.5 rounded-xl bg-white border-2 border-primary text-primary hover:text-white hover:bg-primary transition-all duration-300 shadow-sm hover:shadow-md text-xs sm:text-sm font-semibold flex items-center gap-1.5 cursor-pointer">
                    <x-lucide-chevron-left class="w-4 h-4" />
                    Back
                </button>
                <div x-show="currentStep === 1 || currentStep === totalSteps"></div>

                <div class="flex gap-3">
                    <button @click="showModal = false"
                        x-show="currentStep < totalSteps"
                        class="px-3 py-2 sm:px-4 sm:py-2.5 text-xs sm:text-sm text-gray-800 hover:text-primary font-medium transition-colors cursor-pointer">
                        Skip Survey
                    </button>

                    <button @click="nextStep()"
                        x-show="currentStep < totalSteps - 1"
                        class="px-4 py-2 sm:px-6 sm:py-2.5 rounded-xl bg-white border-2 border-primary text-primary hover:text-white hover:bg-primary transition-all duration-300 shadow-sm hover:shadow-md flex items-center gap-1.5 text-xs sm:text-sm font-semibold cursor-pointer">
                        Next
                        <x-lucide-chevron-right class="w-4 h-4" />
                    </button>

                    <button @click="submitSurvey()"
                        x-show="currentStep === totalSteps - 1"
                        :disabled="isSubmitting"
                        class="px-4 py-2 sm:px-6 sm:py-2.5 rounded-xl bg-linear-to-r from-green-600 to-emerald-600 text-black text-xs sm:text-sm font-semibold hover:from-green-700 hover:to-emerald-700 shadow-lg hover:shadow-xl transition-all duration-200 flex items-center gap-1.5 sm:gap-2 disabled:opacity-50 cursor-pointer">
                        <span x-show="!isSubmitting">Submit Survey</span>
                        <span x-show="isSubmitting" class="flex items-center gap-2">
                            <x-lucide-loader-circle class="animate-spin w-4 h-4" />
                            Submitting...
                        </span>
                    </button>

                    <button @click="showModal = false"
                        x-show="currentStep === totalSteps"
                        class="px-4 py-2 sm:px-6 sm:py-2.5 rounded-xl bg-white border-2 border-primary text-primary hover:text-white hover:bg-primary transition-all duration-300 shadow-sm hover:shadow-md text-xs sm:text-sm font-semibold flex items-center gap-1.5 cursor-pointer">
                        Close
                    </button>
                </div>
            </div>

        </div>
    </div>
</div>

<script>
function feedbackSurvey() {
    const questionsMap = @json($questions);

    return {
        showModal: false,
        currentStep: 1,
        isSubmitting: false,
        responseMessage: '',
        totalSteps: {{ $totalSteps }},
        formData: {
            gender: '',
            age: '',
            @if(!$isStudent)
            current_role: '',
            experience: '',
            @endif
            @foreach($questions as $question)
            {{ $question['q'] }}: '',
            @endforeach
        },
         
        nextStep() {
            if (this.currentStep < this.totalSteps) {
                this.currentStep++;
            }
        },
        prevStep() {
            if (this.currentStep > 1) {
                this.currentStep--;
            }
        },

        getLabel(qKey) {
            const val = this.formData[qKey];
            const qObj = questionsMap.find(item => item.q === qKey);
            if (!qObj) return '';
            const opt = qObj.options.find(o => o.val === val);
            return opt ? opt.val + '. ' + opt.label : '';
        },

        submitSurvey() {
            this.isSubmitting = true;

            // Build payload with full question text + full selected option label
            const answers = questionsMap.map((q) => {
                const selectedVal = this.formData[q.q];
                const selectedOpt = q.options.find(o => o.val === selectedVal);
                return {
                    question: q.text,
                    selected_option: selectedOpt ? selectedOpt.val + '. ' + selectedOpt.label : ''
                };
            });

            const payload = {
                survey_type: '{{ $isStudent ? "student" : "professional" }}',
                gender: this.formData.gender,
                age: this.formData.age,
                @if(!$isStudent)
                current_role: this.formData.current_role,
                experience: this.formData.experience,
                @endif
                answers: answers
            };
            // ===== DEBUG CONSOLE LOGGING =====
            // console.group('🚀 Submitting Survey Data');
            // console.log('API Route:', '{{ route("feedback-form.submit") }}');
            // console.log('Payload Type:', '{{ $isStudent ? "student" : "professional" }}');
            // console.log('Answers Count:', answers.length);
            // console.dir(payload);
            // console.groupEnd();
            // =================================
            
            fetch('{{ route("feedback-form.submit") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || document.querySelector('input[name="_token"]')?.value || '{{ csrf_token() }}'
                },
                body: JSON.stringify(payload)
            })
            .then(res => res.json())
            .then(data => {
                // console.log('✅ Server Response:', data);
                if (data.status === true) {
                    this.responseMessage = data.message;
                    
                    // Auto-close modal after 2.5 seconds
                    setTimeout(() => {
                        this.showModal = false;
                    }, 2500);
                }
                this.isSubmitting = false;
                this.currentStep = this.totalSteps;
            })
            .catch(err => {
                // console.error('❌ Survey submission error:', err);
                this.responseMessage = 'Sorry, something went wrong while submitting your response.';
                this.isSubmitting = false;
                this.currentStep = this.totalSteps;
            });
        }
    }
}
</script>
