@extends('layouts.app') 
@section('title', 'Citations')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
@endsection

<?php
    // Data Configuration
    $citationCategories = [
        [
            'title' => 'Career Interest & Vocational Psychology',
            'theme' => 'primary', // Controls border and accent colors
            'items' => [
                [
                    'text' => 'Holland, J. L. (1997). <em>Making vocational choices: A theory of vocational personalities and work environments</em> (3rd ed.). Psychological Assessment Resources.',
                    'link' => null
                ],
                [
                    'text' => 'Holland, J. L. (1996). Exploring careers with a typology: What we have learned and some new directions. <em>American Psychologist, 51</em>(4), 397–406.',
                    'link' => 'https://doi.org/10.1037/0003-066X.51.4.397'
                ],
                [
                    'text' => 'Savickas, M. L. (2013). Career construction theory and practice. In R. W. Lent & S. D. Brown (Eds.), <em>Career development and counseling: Putting theory and research to work</em> (2nd ed., pp. 147–183). Wiley.',
                    'link' => null
                ],
            ]
        ],
        [
            'title' => 'Aptitude, Intelligence & Cognitive Ability',
            'theme' => 'primary',
            'items' => [
                [
                    'text' => 'Gardner, H. (1983). <em>Frames of mind: The theory of multiple intelligences</em>. Basic Books.',
                    'link' => null
                ],
                [
                    'text' => 'Carroll, J. B. (1993). <em>Human cognitive abilities: A survey of factor-analytic studies</em>. Cambridge University Press.',
                    'link' => null
                ],
                [
                    'text' => 'Gottfredson, L. S. (2002). Where and why g matters: Not a mystery. <em>Human Performance, 15</em>(1–2), 25–46.',
                    'link' => 'https://doi.org/10.1080/08959285.2002.9668082'
                ],
            ]
        ],
        [
            'title' => 'Personality Psychology',
            'theme' => 'primary',
            'items' => [
                [
                    'text' => 'McCrae, R. R., & Costa, P. T. (1997). Personality trait structure as a human universal. <em>American Psychologist, 52</em>(5), 509–516.',
                    'link' => 'https://doi.org/10.1037/0003-066X.52.5.509'
                ],
                [
                    'text' => 'John, O. P., Donahue, E. M., & Kentle, R. L. (1991). <em>The Big Five Inventory—Versions 4a and 54</em>. University of California, Berkeley.',
                    'link' => null
                ],
                [
                    'text' => 'Roberts, B. W., Kuncel, N. R., Shiner, R., Caspi, A., & Goldberg, L. R. (2007). The power of personality: The comparative validity of personality traits, socioeconomic status, and cognitive ability for predicting important life outcomes. <em>Perspectives on Psychological Science, 2</em>(4), 313–345.',
                    'link' => 'https://doi.org/10.1111/j.1745-6916.2007.00047.x'
                ],
            ]
        ],
        [
            'title' => 'Adolescent Development & Decision-Making',
            'theme' => 'primary',
            'items' => [
                [
                    'text' => 'Steinberg, L. (2005). Cognitive and affective development in adolescence. <em>Trends in Cognitive Sciences, 9</em>(2), 69–74.',
                    'link' => 'https://doi.org/10.1016/j.tics.2004.12.005'
                ],
                [
                    'text' => 'Eccles, J. S., & Wigfield, A. (2002). Motivational beliefs, values, and goals. <em>Annual Review of Psychology, 53</em>, 109–132.',
                    'link' => 'https://doi.org/10.1146/annurev.psych.53.100901.135153'
                ],
                [
                    'text' => 'Super, D. E. (1990). A life-span, life-space approach to career development. In D. Brown & L. Brooks (Eds.), <em>Career choice and development</em> (2nd ed., pp. 197–261). Jossey-Bass.',
                    'link' => null
                ],
            ]
        ],
        [
            'title' => 'Assessment Validity & Psychometrics',
            'theme' => 'primary',
            'items' => [
                [
                    'text' => 'Cronbach, L. J. (1951). Coefficient alpha and the internal structure of tests. <em>Psychometrika, 16</em>(3), 297–334.',
                    'link' => 'https://doi.org/10.1007/BF02310555'
                ],
                [
                    'text' => 'American Educational Research Association, American Psychological Association, & National Council on Measurement in Education. (2014). <em>Standards for educational and psychological testing</em>. American Educational Research Association.',
                    'link' => null
                ],
                [
                    'text' => 'Messick, S. (1995). Validity of psychological assessment: Validation of inferences from persons\' responses and performances. <em>American Psychologist, 50</em>(9), 741–749.',
                    'link' => 'https://doi.org/10.1037/0003-066X.50.9.741'
                ],
            ]
        ],
        [
            'title' => 'Motivation, Orientation & Self-Concept',
            'theme' => 'primary',
            'items' => [
                [
                    'text' => 'Deci, E. L., & Ryan, R. M. (2000). The "what" and "why" of goal pursuits: Human needs and the self-determination of behavior. <em>Psychological Inquiry, 11</em>(4), 227–268.',
                    'link' => 'https://doi.org/10.1207/S15327965PLI1104_01'
                ],
                [
                    'text' => 'Bandura, A. (1997). <em>Self-efficacy: The exercise of control</em>. W. H. Freeman.',
                    'link' => null
                ],
            ]
        ]
    ];
?>

@section('content')

    {{-- SECTION 1: HERO Section --}}
    <section class="relative bg-secondary w-full">
        <div class="max-w-7xl mx-auto px-4 md:px-6 pt-16 pb-0  relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 justify-between items-start">
                
                {{-- 2. Left Side: Text Content --}}
                <div class="text-center md:text-left space-y-6 w-full md:max-w-xl pt-0 md:pt-12">
                    <h1 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-black leading-tight font-sans">
                       Research-backed citations
                    </h1>
                    
                    <p class="text-textBlack text-lg md:text-xl leading-tight">
                        All studies are foundational, peer-reviewed, and widely accepted in psychology, education, and career development.
                    </p>

                    <div class="pt-0">
                        <x-button variant="primary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="#">Request a Demo</x-button>
                        <x-button variant="secondary" as="a" class="mt-6 w-9/12 md:w-50 lg:w-60" href="{{ route('register.select') }}">Start Free Trial</x-button>
                    </div>
                </div>

                {{-- 3. Right Side: OverlapDevice Mockup Image --}}
                <div class="text-center">
                    <img src="{{ asset('assets/image/citations.svg') }}" 
                    alt="Research-backed citations" fetchpriority="high"
                    class="mx-auto pointer-events-none w-[350px] mt-3 md:mt-0">
                </div>

            </div>
        </div>
    </section>
    <section class="relative w-full py-16 lg:py-22">
        <div class="max-w-7xl mx-auto px-4 md:px-6">
            {{-- Header Section --}}
            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans ">
            Our scientific foundation
            </h2>    
            {{-- Text Content --}}   
            <p class="lg:max-w-[992px] mx-auto text-textBlack text-center text-base md:text-lg leading-relaxed mb-8 md:mb-10">
            Udyantra's assessments are built on decades of peer-reviewed research in psychology, education, and career development.
            </p>
            @foreach($citationCategories as $category)
            <div class="mb-16">
                {{-- Category Header --}}
                <div class="flex items-center gap-3 mb-8">
                    {{-- Dynamic Color Bar (Primary/Secondary) --}}
                    <div class="h-10 w-1.5 bg-{{ $category['theme'] }} rounded-full"></div>
                    <h2 class="text-2xl md:text-3xl font-bold text-gray-800 tracking-tight">
                        {{ $category['title'] }}
                    </h2>
                </div>
                
                {{-- Grid of Cards --}}
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($category['items'] as $citation)
                    <div class="group relative p-6 bg-white rounded-xl shadow transition-all duration-300 hover:shadow-xl hover:-translate-y-1 border-l-4 border-{{ $category['theme'] }}">
                        <p class="text-gray-700 leading-relaxed text-sm">
                            {{-- {!! !!} allows HTML like <em> to render --}}
                            {!! $citation['text'] !!}
                            
                            @if($citation['link'])
                            <br>
                            <a href="{{ $citation['link'] }}" target="_blank" class="text-primary hover:text-secondary underline break-all mt-1 inline-block">
                                {{ str_replace('https://', '', $citation['link']) }}
                            </a>
                            @endif
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
            <div class="bg-linear-to-br from-teal-50 to-cyan-50 rounded-xl shadow-lg p-6  border-2 border-secondary relative overflow-hidden">
                <div class="group relative z-10 flex flex-col md:flex-row items-start gap-6">
                      <div class="shrink-0">
                        <svg class="w-14 h-14 text-primary" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-start text-black font-sans ">
                             How this strengthens Udyantra
                        </h2>    
                         {{-- Text Content --}}   
                        <p class="text-textBlack text-start text-base md:text-lg leading-relaxed mb-6">
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
    {{-- SECTION 2: Citations Grid Section --}}
   

    {{-- SECTION : Success Stories --}}
    <section class="pt-14 lg:pt-20 pb-16 lg:pb-22 bg-lightgray font-sans relative z-10">
        <div class="max-w-7xl mx-auto px-4 md:px-4">
            <h2 class="text-sizeMobile lg:text-sizeDesktop font-semibold text-center text-black font-sans mb-8 md:mb-10">
                Success stories from our customers
            </h2>
            <div class="bg-white rounded-xl shadow-xl p-4 md:p-10 relative -mb-60 md:-mb-70 fade-sides">
                <x-testimonials />
            </div>
        </div>
    </section>

    {{-- Section : FAQs --}}
    <section class="font-sans relative z-0 pt-56 md:pt-70 lg:pt-68 pb-16 lg:py-22">
        <x-faq />
    </section>

@endsection