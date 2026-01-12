@extends('layouts.app') 
@section('title', 'Citations')
@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

@section('content')

    {{-- SECTION 1: HERO Section --}}
    <section class="relative bg-gray-100 w-full pt-14 pb:16 lg:pt-20 lg:pb-22">

        <div class="max-w-7xl mx-auto px-4 md:px-6">
            <div class="grid gap-8 items-center">
                
                {{-- Text Content --}}
                <div class="text-center space-y-6 w-full lg:max-w-[992px] mx-auto">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                        Research-Backed Citations
                    </h1>
                    
                    <p class="text-textBlack text-base md:text-lg leading-tight">
                        All studies are foundational, peer-reviewed, and widely accepted in psychology, education, and career development.
                    </p>

                    <div class="block md:inline-flex centent-start items-center gap-3">
                        <x-button variant="primary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="#">Request a Demo</x-button>
                        <x-button variant="secondary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="{{ route('register') }}">Start Free Trial</x-button>
                    </div>

                </div>

            </div>
        </div>
    </section>

    {{-- SECTION 2: Citations Grid Section --}}
    <section class="relative w-full pt-14 pb:16 lg:pt-20 lg:pb-22">

        <div class="container mx-auto px-4">

            {{-- Header Section --}}
            <div class="container mx-auto px-4 text-center mb-12">
                <h1 class="text-3xl md:text-4xl font-sans font-semibold mb-4">
                    Our Scientific Foundation
                </h1>
                <p class="text-gray-600 max-w-3xl mx-auto">
                    Udyantra's assessments are built on decades of peer-reviewed research in psychology, education, and career development.
                </p>
            </div>

            {{-- Career Interest & Vocational Psychology --}}
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-10 w-1.5 bg-primary rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        Career Interest & Vocational Psychology
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Holland, J. L. (1997). <em>Making vocational choices: A theory of vocational personalities and work environments</em> (3rd ed.). Psychological Assessment Resources.
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Holland, J. L. (1996). Exploring careers with a typology: What we have learned and some new directions. <em>American Psychologist, 51</em>(4), 397–406. 
                            <a href="https://doi.org/10.1037/0003-066X.51.4.397" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1037/0003-066X.51.4.397</a>
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Savickas, M. L. (2013). Career construction theory and practice. In R. W. Lent & S. D. Brown (Eds.), <em>Career development and counseling: Putting theory and research to work</em> (2nd ed., pp. 147–183). Wiley.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Aptitude, Intelligence & Cognitive Ability --}}
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-10 w-1.5 bg-secondary rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        Aptitude, Intelligence & Cognitive Ability
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Gardner, H. (1983). <em>Frames of mind: The theory of multiple intelligences</em>. Basic Books.
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Carroll, J. B. (1993). <em>Human cognitive abilities: A survey of factor-analytic studies</em>. Cambridge University Press.
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Gottfredson, L. S. (2002). Where and why g matters: Not a mystery. <em>Human Performance, 15</em>(1–2), 25–46. 
                            <a href="https://doi.org/10.1080/08959285.2002.9668082" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1080/08959285.2002.9668082</a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Personality Psychology --}}
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-10 w-1.5 bg-primary rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        Personality Psychology
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            McCrae, R. R., & Costa, P. T. (1997). Personality trait structure as a human universal. <em>American Psychologist, 52</em>(5), 509–516. 
                            <a href="https://doi.org/10.1037/0003-066X.52.5.509" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1037/0003-066X.52.5.509</a>
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            John, O. P., Donahue, E. M., & Kentle, R. L. (1991). <em>The Big Five Inventory—Versions 4a and 54</em>. University of California, Berkeley.
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Roberts, B. W., Kuncel, N. R., Shiner, R., Caspi, A., & Goldberg, L. R. (2007). The power of personality: The comparative validity of personality traits, socioeconomic status, and cognitive ability for predicting important life outcomes. <em>Perspectives on Psychological Science, 2</em>(4), 313–345. 
                            <a href="https://doi.org/10.1111/j.1745-6916.2007.00047.x" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1111/j.1745-6916.2007.00047.x</a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Adolescent Development & Decision-Making --}}
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-10 w-1.5 bg-secondary rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        Adolescent Development & Decision-Making
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Steinberg, L. (2005). Cognitive and affective development in adolescence. <em>Trends in Cognitive Sciences, 9</em>(2), 69–74. 
                            <a href="https://doi.org/10.1016/j.tics.2004.12.005" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1016/j.tics.2004.12.005</a>
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Eccles, J. S., & Wigfield, A. (2002). Motivational beliefs, values, and goals. <em>Annual Review of Psychology, 53</em>, 109–132. 
                            <a href="https://doi.org/10.1146/annurev.psych.53.100901.135153" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1146/annurev.psych.53.100901.135153</a>
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Super, D. E. (1990). A life-span, life-space approach to career development. In D. Brown & L. Brooks (Eds.), <em>Career choice and development</em> (2nd ed., pp. 197–261). Jossey-Bass.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Assessment Validity & Psychometrics --}}
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-10 w-1.5 bg-primary rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        Assessment Validity & Psychometrics
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Cronbach, L. J. (1951). Coefficient alpha and the internal structure of tests. <em>Psychometrika, 16</em>(3), 297–334. 
                            <a href="https://doi.org/10.1007/BF02310555" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1007/BF02310555</a>
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            American Educational Research Association, American Psychological Association, & National Council on Measurement in Education. (2014). <em>Standards for educational and psychological testing</em>. American Educational Research Association.
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-primary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Messick, S. (1995). Validity of psychological assessment: Validation of inferences from persons' responses and performances. <em>American Psychologist, 50</em>(9), 741–749. 
                            <a href="https://doi.org/10.1037/0003-066X.50.9.741" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1037/0003-066X.50.9.741</a>
                        </p>
                    </div>
                </div>
            </div>

            {{-- Motivation, Orientation & Self-Concept --}}
            <div class="mb-16">
                <div class="flex items-center gap-3 mb-8">
                    <div class="h-10 w-1.5 bg-secondary rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        Motivation, Orientation & Self-Concept
                    </h2>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Deci, E. L., & Ryan, R. M. (2000). The "what" and "why" of goal pursuits: Human needs and the self-determination of behavior. <em>Psychological Inquiry, 11</em>(4), 227–268. 
                            <a href="https://doi.org/10.1207/S15327965PLI1104_01" target="_blank" class="text-primary hover:text-secondary underline break-all">doi.org/10.1207/S15327965PLI1104_01</a>
                        </p>
                    </div>
                    
                    <div class="group relative p-6 bg-white rounded-2xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-secondary">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            Bandura, A. (1997). <em>Self-efficacy: The exercise of control</em>. W. H. Freeman.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Why This Matters Section --}}
            <div class="bg-gradient-to-br from-teal-50 to-cyan-50 rounded-2xl shadow-lg p-8 md:p-10 border-2 border-secondary relative overflow-hidden">
                <div class="group relative z-10 flex flex-col md:flex-row items-start gap-6">
                     <div class="shrink-0">
                        <svg class="w-14 h-14 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">
                            How this strengthens Udyantra
                        </h2>
                        <p class="text-gray-700 text-base leading-relaxed mb-4">
                            Using these references shows that:
                        </p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">Our assessments are <strong>theory-backed</strong>, not opinion-based</span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">We align with <strong>global psychological standards</strong></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">Parents and schools can <strong>trust the methodology</strong></span>
                            </li>
                            <li class="flex items-start gap-3">
                                <svg class="w-5 h-5 text-primary shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <span class="text-gray-700">We meet expectations for <strong>ethical assessment design</strong></span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- SECTION : Success Stories --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-lightgray font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-4">

            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Success stories from our customers
            </h2>

            {{-- MOVING CONTENT STORIES --}}
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-10 relative -mb-60 md:-mb-70 fade-sides">
            
            {{-- Carousel Logic --}}
                <x-testimonials />

            </div>
        </div>
    </section>

    {{-- Section : FAQs --}}
    <section class="font-sans relative z-0 pt-56 md:pt-70 lg:pt-68 pb-16 lg:py-22">
        <x-faq />
    </section>

@endsection
