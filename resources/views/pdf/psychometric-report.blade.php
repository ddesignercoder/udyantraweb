<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Psychometric Test Report</title>


    <style>
        @page {
            margin: 80px 40px 50px 40px;
        }
        body {
            font-family: 'DejaVu Sans', sans-serif;
            margin: 0;
            padding: 0;
            color: #000000;
            font-size: 14px;
            line-height: 1.6;
        }
        .page-break {
            page-break-after: always;
        }
        .header, .footer {
            position: fixed;
            left: -40px;
            right: -40px;
            background-color: #018580;
            padding: 10px 20px;
            box-sizing: border-box;
        }
        .header {
            top: -80px;
            height: 50px;
            border-bottom: 2px solid #6fc7c4;
        }
        .footer {
            bottom: -50px;
            height: 50px;
            text-align: center;
            /* font-size: 10px; */
            color: #ffffff;
            border-top: 1px solid #6fc7c4;
        }
        .content {
            /* Margins handled by @page */
        }
        .cover-page {
            text-align: center;
            margin-top: 120px; /* Adjusted for page margin */
        }
        h1 {
            color: #0e141a;
            font-size: 30px;
            margin-bottom: 10px;
        }
        h2 {
            color: #0e141a;
            font-size: 22px;
            margin-top: 30px;
            border-bottom: 2px solid #0e141a;
            padding-bottom: 5px;
        }
        h3 {
            color: #6fc7c4;
            font-size: 18px;
            margin-top: 20px;
        }
        .highlight {
            color: #018580;
            font-weight: bold;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #6fc7c4;
            color: #ffffff;
            font-weight: bold;
        }
        .bar-container {
            width: 100%;
            background-color: #eee;
            border-radius: 4px;
            overflow: hidden;
            height: 15px;
        }
        .bar {
            height: 100%;
            background-color: #018580;
            text-align: right;
            line-height: 15px;
            color: white;
            font-size: 10px;
            padding-right: 5px;
        }
        .summary-box {
            background-color: #f8f9fa;
            border-left: 4px solid #018580;
            padding: 12px;
            margin-bottom: 20px;
            border-radius: 0 4px 4px 0;
            font-size: 13px;
            line-height: 1.7;
            box-shadow: 1px 1px 3px rgba(0,0,0,0.05);
        }
        .summary-title {
            color: #018580;
            font-weight: bold;
            font-size: 15px;
            margin-bottom: 5px;
            display: block;
            border-bottom: 1px solid #e0e0e0;
            padding-bottom: 3px;
        }
        .tag {
            display: inline-block;
            background-color: #e0f5f4;
            color: #018580;
            padding: 2px 4px;
            border-radius: 12px;
            font-size: 13px;
            margin-right: 5px;
            margin-bottom: 5px;
        }
        .rec-block {
            margin-bottom: 15px;
        }
        .rec-title {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
            color: #000000;
        }
        .rec-tags {
            line-height: 2.2;
        }
        /* Grid system simulation */
        .row:after {
            content: "";
            display: table;
            clear: both;
        }
        .col-6 {
            float: left;
            width: 48%;
            margin-right: 2%;
        } 
        .col-6:last-child {
            margin-right: 0;
        }



        /* Utility */
        .text-center { text-align: center; }
        .mt-4 { margin-top: 20px; }
        .mb-4 { margin-bottom: 20px; }
        .closing-page {
            page-break-before: always;
            text-align: center;
            padding-top: 220px;
        }
        .closing-slogan {
            max-width: 520px;
            margin: 0 auto;
            padding: 24px 28px;
            border: 2px solid #018580;
            border-radius: 14px;
            background-color: #f4fbfb;
            color: #0e141a;
            font-size: 20px;
            font-weight: bold;
            line-height: 1.8;
        }
    </style>
</head>
<body>

    {{-- Logo Integration --}}
    <?php
        $logoPath = public_path('assets/image/Udyantra-Logo.png');
        $logoBase64 = '';
        if (file_exists($logoPath)) {
            $type = pathinfo($logoPath, PATHINFO_EXTENSION);
            $data = file_get_contents($logoPath);
            $logoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($data);
        }

        // Load logo symbol for background watermark
        $logoSymbolPath = public_path('assets/image/pdf-report-image/udyantra-leaf.txt');
        $logoSymbolBase64 = '';
        if (file_exists($logoSymbolPath)) {
            $logoSymbolBase64 = trim(file_get_contents($logoSymbolPath));
        }
    ?>

    <!-- Cover Page -->
    <div class="cover-page">
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" style="max-width: 250px; margin-bottom: 20px;" alt="Udyantra Logo">
        @else
            <div style="margin-bottom: 30px; font-size: 40px; color: #ccc;">LOGO</div>
        @endif
        
        <h1>Psychometric Assessment Report</h1>
        <p style="font-size: 18px; color: #0e141a;">Comprehensive Analysis & Guidance</p>
        
        <div style="margin-top: 50px; border: 1px solid #000000; display: inline-block; padding: 20px 40px; background-color: #f9f9f9;">
            <p><strong>Prepared For:</strong></p>
            <h2 style="margin: 0; padding: 0; border: none; color: #0e141a;">{{ $user_name }}</h2>
            @if($school_name)
                <h2 style="margin: 0; padding: 0; border: none; color: #0e141a;">{{$school_name}}</h2>
                <h2 style="margin: 0; padding: 0; border: none; color: #0e141a;">Class: {{$class}} | Section: {{$section}}</h2>
                <h2 style="margin: 0; padding: 0; border: none; color: #0e141a;">Roll No: {{$roll_no}}</h2>
            @endif
            <p style="margin-top: 10px; color: #0e141a;">Test Date: {{ date('F j, Y') }}</p>
        </div>
    </div>

    <div class="page-break"></div>

    <!-- Header & Footer for content pages -->
    {{-- Note: DomPDF handles fixed positioned elements on every page --}}
    <div class="header">
        <div style="text-align: center; font-weight: bold; color: #fff; font-size: 18px; line-height: 30px;">Udyantra Psychometric Analysis</div>
        @if($logoBase64)
            <img src="{{ $logoBase64 }}" style="position: absolute; right: 40px; top: 8px; height: 40px; background-color: #fff; padding: 5px; border-radius: 5px;" alt="Udyantra Logo">
        @endif
    </div>

    <div class="footer">
        <p style="color: #fff; font-size: 18px; font-weight: bold;text-align: center; line-height: 40px; margin: 0;">Mapping strengths to future possibilities</p>
    </div>

    {{-- Background watermark on every page --}}
    @if($logoSymbolBase64)
    <div style="position: fixed; bottom: 40px; right: -20px;opacity: 0.8;">
        <img src="{{ $logoSymbolBase64 }}" style="width: 300px; height: auto;" />
    </div>
    @endif

    <!-- Content Pages -->
    <div class="content">
        <h2>Report Overview</h2>
        <div class="summary-box">
            <p><strong>Test Type:</strong> {{ str_replace('_', ' ', $test_name) }}</p>
            <p><strong>Status:</strong> Completed Successfully</p>
        </div>

        <p>This report provides a detailed analysis of your psychometric profile, covering Personality, Learning Orientation, Aptitude, and Motivation. Based on these factors, we have curated career suggestions that align with your natural strengths.</p>

        @if($analysis['is_tie_scenario'])
        <div style="background-color: #fff3cd; border: 1px solid #ffeeba; color: #856404; padding: 10px; margin-top: 10px; border-radius: 4px;">
            <strong>Note:</strong> We detected a balanced profile in some areas (tie scenario). The recommendations below consider multiple dominant traits to give you a broader perspective.
        </div>
        @endif

        <h2>Your Core Profile</h2>
        <p>Based on your responses, here are your dominant traits in each category:</p>

        <table style="margin-top: 15px;">
            <thead>
                <tr>
                    <th width="30%">Category</th>
                    <th>Dominant Trait(s)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($analysis['user_profile_winners'] as $category => $traits)
                <tr>
                    <td><strong>{{ $category }}</strong></td>
                    <td>
                        @foreach($traits as $trait)
                            <span class="tag">{{ $trait }}</span>
                        @endforeach
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        @php
            $roleImage = null;
            $imagePath = '';
            $imagePath = public_path('assets/image/pdf-report-image/udyantra-pdf-image.png');
            if ($imagePath && file_exists($imagePath)) {
                $type = pathinfo($imagePath, PATHINFO_EXTENSION);
                $data = file_get_contents($imagePath);
                $roleImage = 'data:image/' . $type . ';base64,' . base64_encode($data);
            }
        @endphp

        @if($roleImage)
            <div style="text-align: center;">
                <img src="{{ $roleImage }}" style="max-width: 100%; height: auto;"/>
            </div>
        @endif

        @foreach($chart_images as $category => $chart)
            @php
                $traitKey = strtoupper($category);
                $jsonProfileKey = $profile_key === 'forStudents' ? 'for_students' : 'for_professionals';
                $traits = $sub_section_traits[$traitKey] ?? [];
            @endphp
            <div style="page-break-before: always; page-break-inside: avoid;">
                <h2 style="text-align: left; margin-bottom: 5px; margin-top: 0;">Detailed Subsection Analysis : {{ $category }}</h2>
                <div style="text-align: center; margin-bottom: 5px;">
                    <img src="data:image/png;base64,{{ $chart['base64'] }}" style="max-width: 90%; max-height: 380px; height: auto;" />
                </div>

                {{-- Trait descriptions from sub-section.json --}}
                @if(!empty($traits))
                    <table style="width: 100%; border-collapse: collapse; margin-top: 0;">
                        <thead>
                            <tr>
                                <th style="width: 22%; padding: 5px 8px; font-size: 18px; text-align: left; background-color: #018580; color: #fff; border: 1px solid #ddd;">Trait</th>
                                <th style="padding: 5px 8px; font-size: 18px; text-align: left; background-color: #018580; color: #fff; border: 1px solid #ddd;">Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($traits as $trait)
                                <tr>
                                    <td style="padding: 5px 8px; font-size: 14px; font-weight: bold; color: #018580; border: 1px solid #e0e0e0; vertical-align: top;">{{ $trait['name'] }}</td>
                                    <td style="padding: 5px 8px; font-size: 14px; line-height: 1.4; border: 1px solid #e0e0e0;">{{ $trait[$jsonProfileKey] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        @endforeach

        <!-- Career Recommendations / Outcomes -->
        @foreach($outcomes as $index => $outcome)
            <div style="border: 1px solid #ddd;margin-top: 50px ;padding: 15px; border-radius: 8px; font-size: 14px; page-break-before: always;">
                @if($loop->first)
                    <h2 style="margin-top: 0; margin-bottom: 5px;">Career & Stream Recommendations</h2>
                    <p style="margin-top: 0; margin-bottom: 10px;">Based on the combination of your profiles, we have identified the following career paths that would be a strong fit for you.</p>
                @endif
                <h3 style="margin-top: 0; margin-bottom: 5px; color: #6fc7c4; font-size: 18px;">Option {{ $index + 1 }}</h3>
                
                <div class="summary-box" style="padding: 8px; margin-bottom: 8px;">
                    <span class="summary-title" style="font-size: 16px; margin-bottom: 3px; padding-bottom: 2px;">Profile Snapshot</span>
                    @php
                        $summary = $outcome['short_summary'];
                        $summary = str_replace('Learning Orientation:', '<br><strong>Learning Orientation:</strong>', $summary);
                        $summary = str_replace('Personality:', '<br><strong>Personality:</strong>', $summary);
                        $summary = str_replace('Dominant Aptitude:', '<br><strong>Dominant Aptitude:</strong>', $summary);
                        $summary = str_replace('Interest/Motivation:', '<br><strong>Interest/Motivation:</strong>', $summary);
                        $summary = preg_replace('/Recommended Stream\(s\):.*$/s', '', $summary);
                        
                        if (strpos($summary, '<br>') === 0) {
                            $summary = substr($summary, 4);
                        }
                    @endphp
                    <div style="font-size: 14px; line-height: 1.5;">{!! $summary !!}</div>
                </div>

                @if(str_contains($test_name, 'SENIOR'))
                <div class="rec-block" style="margin-bottom: 8px;">
                    <span class="rec-title" style="font-size: 16px; margin-bottom: 10px;">Carrier Match With:</span>
                    <div class="rec-tags" style="line-height: 1.8;">
                        @foreach(explode(';', $outcome['suggested_streams']) as $stream)
                            <span class="tag" style="background-color: #e0f5f4; color: #018580; font-size: 14px; padding: 2px 5px;">{{ trim($stream) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                @if(!str_contains($test_name, 'PROFESSIONAL'))
                <div class="rec-block" style="margin-bottom: 8px;">
                    <span class="rec-title" style="font-size: 16px; margin-bottom: 10px;">Suggested Subjects:</span>
                    <div class="rec-tags" style="line-height: 1.8;">
                        @foreach(explode(';', $outcome['suggested_subjects']) as $subject)
                            <span class="tag" style="background-color: #e0f5f4; color: #018580; font-size: 14px; padding: 2px 5px;">{{ trim($subject) }}</span>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="row" style="margin-top: 8px;">
                    <div class="col-6">
                        <strong>Strengths:</strong>
                        <ul style="margin-top: 2px; padding-left: 18px; margin-bottom: 0;">
                           @foreach(explode(';', $outcome['strengths']) as $strength)
                                <li>{{ trim($strength) }}</li>
                           @endforeach 
                        </ul>
                    </div>
                    <div class="col-6">
                        <strong>Areas of Improvement:</strong>
                        <ul style="margin-top: 2px; padding-left: 18px; margin-bottom: 0;">
                            @foreach(explode(';', $outcome['areas_to_improve']) as $area)
                                <li>{{ trim($area) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        @endforeach
        
        <!-- Detailed Skill Analysis -->
        <h2 style="page-break-before: always;">Detailed Skill Analysis</h2>
        <p>A deeper look into your key strengths and areas for growth, with actionable steps for improvement.</p>

        @if(!empty($detailed_areas))
            <h3 style="color: #c0392b; font-size: 18px;">AREAS OF IMPROVEMENT & MASTER</h3>
            @foreach($detailed_areas as $skill)
                @if($loop->index > 0 && $loop->index % 2 == 0)
                    <div class="page-break"></div>
                @endif
                <div class="summary-box" style="border-left-color: #c0392b; margin-top: 50px; font-size: 14px;">

                    <span class="summary-title" style="color: #c0392b; font-size: 16px;">{{ $skill['title'] }}</span>
                    <p><strong>Definition:</strong> {{ $skill[$profile_key]['definition'] }}</p>
                    
                    <div class="row">
                        <div class="col-6">
                            <strong style="font-size: 14px;">How to Improve:</strong>
                            <ul style="margin-top: 5px; padding-left: 15px; font-size: 14px;">
                                @foreach($skill[$profile_key]['howToImprove'] as $tip)
                                    <li>{{ $tip }}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-6">
                            <strong style="font-size: 14px;">Suggested Exercises:</strong>
                            <ul style="margin-top: 5px; padding-left: 15px; font-size: 14px;">
                                @foreach($skill[$profile_key]['exercises'] as $exercise)
                                    <li>{{ $exercise }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    

                </div>
            @endforeach
        @endif

        @if(!empty($detailed_strengths)) 
            <h3 style="color: #27ae60; font-size: 20px; page-break-before: always; margin-bottom: 60px;">YOUR STRENGTH BUILDERS</h3>
            @foreach($detailed_strengths as $skill)
                @if($loop->index > 0 && $loop->index % 4 == 0)
                    <div class="page-break"></div>
                @endif
                <div class="summary-box" style="border-left-color: #27ae60; font-size: 14px;">

                    <span class="summary-title" style="color: #27ae60; font-size: 16px;">{{ $skill['title'] }}</span>
                    <p> {{ $skill[$profile_key]['definition'] }}</p>
                </div>
            @endforeach
        @endif

        <div class="closing-page">
            <div class="closing-slogan">
                Growth is a continuous process. Work on the areas highlighted in this report and take the assessment again after a few months to evaluate your progress and refine your direction.
            </div>
        </div>
    </div>

</body>
</html>
