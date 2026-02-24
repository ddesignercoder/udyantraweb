<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfGenerator;
use CpChart\Data;
use CpChart\Image;
use CpChart\Chart\Pie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class PdfReportController extends Controller
{
    protected $pdfGenerator;

    public function __construct(PdfGenerator $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    public function fetchPdfReport($user_id, $test_result_id)
    {
        $user_id = decrypt($user_id);
        $test_result_id = decrypt($test_result_id);
        $baseUrl = config('services.backend.url');
        $token = session('api_token');

        // Call the API from the Server
        $response = Http::withToken($token)
            ->acceptJson()
            ->get("{$baseUrl}/career-analysis", [
                'user_id' => $user_id,
                'test_result_id' => $test_result_id,
                'pdf_report' => 1,
            ]);

        if ($response->successful()) {
            return $response->json();
        }

        return null;
    }

    /**
     * Generate a pie chart PNG as base64 using CpChart (GD).
     */
    private function generatePieChartBase64(array $values, array $labels, array $hexColors)
    {
        // Format labels to include percentage values
        $labelWithPct = [];
        foreach ($labels as $i => $label) {
            $labelWithPct[] = '  ' . $label . ' (' . $values[$i] . '%)  ';
        }

        $data = new Data();
        $data->addPoints($values, 'Values');
        $data->addPoints($labelWithPct, 'Labels');
        $data->setAbscissa('Labels');

        // Set colors for each slice
        $palette = [];
        foreach ($hexColors as $i => $hex) {
            $hex = ltrim($hex, '#');
            $palette[$i] = [
                'R' => hexdec(substr($hex, 0, 2)),
                'G' => hexdec(substr($hex, 2, 2)),
                'B' => hexdec(substr($hex, 4, 2)),
                'Alpha' => 100,
            ];
        }

        // A4-optimized: reduced canvas to fit chart + descriptions on one page
        $image = new Image(1200, 750, $data);
        $fontPath = base_path('vendor/szymach/c-pchart/resources/fonts/verdana.ttf');
        $image->setFontProperties(['FontName' => $fontPath, 'FontSize' => 17]);

        // Apply custom palette
        foreach ($palette as $idx => $color) {
            $image->drawRectangle(0, 0, 0, 0, [
                'R' => 255, 'G' => 255, 'B' => 255, 'Alpha' => 0
            ]);
        }

        $pie = new Pie($image, $data);

        // Set slice colors
        foreach ($palette as $idx => $color) {
            $pie->setSliceColor($idx, $color);
        }

        // Pie centered horizontally, upper portion of canvas
        $pie->draw2DPie(600, 325, [
            'Radius' => 250,
            'StartAngle' => 120,
            'Border' => true,
            'BorderR' => 255, 'BorderG' => 255, 'BorderB' => 255,
            'DrawLabels' => true,
            // 'LabelColor' => PIE_LABEL_COLOR_AUTO,
        ]);

        // Legend centered below pie
        // $pie->drawPieLegend(200, 1600, [
        //     'FontSize' => 40,
        //     'BoxSize' => 80,
        //     'Margin' => 30, // Increases vertical spacing between items
        // ]);

        // CpChart's __toString() returns PNG binary data
        $pngData = (string) $image;

        return base64_encode($pngData);
    }

    /**
     * Build chart data (base64 PNG) for all subsection categories.
     */
    private function buildChartImages($subsectionAnalysis)
    {
        $colorPalettes = [
            'Personality' => ['#6C5CE7', '#00B894', '#FDCB6E', '#E17055', '#0984E3'],
            'Orientation' => ['#E84393', '#00CEC9', '#6C5CE7', '#FDCB6E'],
            'Aptitude'    => ['#0984E3', '#E17055', '#00B894', '#A29BFE'],
            'Motivation'  => ['#00CEC9', '#E84393', '#FDCB6E', '#6C5CE7', '#00B894'],
        ];

        $charts = [];
        foreach ($subsectionAnalysis as $category => $items) {
            $values = array_column($items, 'percentage');
            $labels = array_column($items, 'subsection');
            $colors = $colorPalettes[$category] ?? ['#cccccc'];

            $charts[$category] = [
                'base64' => $this->generatePieChartBase64($values, $labels, $colors),
            ];
        }
        return $charts;
    }

    public function pdfReport($user_id, $test_result_id)
    {
        // Cache key unique per user + test result
        $cacheKey = 'pdf_report_' . md5($user_id . '_' . $test_result_id);

        // Check if cached PDF exists (cached for 24 hours)
        $cachedPdf = Cache::get($cacheKey);
        if ($cachedPdf) {
            return response($cachedPdf, 200, [
                'Content-Type' => 'application/pdf',
                'Content-Disposition' => 'inline; filename="udyantra-psychometric-report.pdf"',
            ]);
        }

        // Fetch real data from the API
        $data = $this->fetchPdfReport($user_id, $test_result_id);

        if (!$data || $data['status'] !== 'success') {
            abort(500, 'Failed to fetch report data from the API.');
        }

        // Fetch Areas JSON Logic
        $areasJsonPath = public_path('assets/pdf-report/area-of-improvement.json');
        $areasData = [];
        if (file_exists($areasJsonPath)) {
            $areasData = json_decode(file_get_contents($areasJsonPath), true);
        }

        // Fetch Strengths JSON Logic
        $strengthsJsonPath = public_path('assets/pdf-report/strength.json');
        $strengthsData = [];
        if (file_exists($strengthsJsonPath)) {
            $strengthsData = json_decode(file_get_contents($strengthsJsonPath), true);
        }

        // Fetch Sub-section Traits JSON Logic
        $subSectionJsonPath = public_path('assets/pdf-report/sub-section.json');
        $subSectionTraits = [];
        if (file_exists($subSectionJsonPath)) {
            $subSectionData = json_decode(file_get_contents($subSectionJsonPath), true);
            $subSectionTraits = $subSectionData['traits'] ?? [];
        }

        // Determine Profile Type (Student vs Professional)
        // SENIOR / JUNIOR -> Student context
        // PROFESSIONAL -> Professional context
        $isStudent = false;
        if (str_contains($data['test_name'], 'SENIOR') || str_contains($data['test_name'], 'JUNIOR')) {
            $isStudent = true;
        }

        $profileKey = $isStudent ? 'forStudents' : 'forProfessionals';

        // Extract Strengths and Areas from Outcome 0 (Primary Outcome)
        $outcome = $data['outcomes'][0];
        //$strengthsList = array_filter(array_map('trim', preg_split('/[,;]|\band\b/i', $outcome['strengths'])));
        $strengthsList = array_map('trim', explode(';', $outcome['strengths']));
        $areasList = array_map('trim', explode(';', $outcome['areas_to_improve']));
        // $areasList = array_filter(array_map('trim', preg_split('/[,;]|\band\b/i', $outcome['areas_to_improve']))); 

        // Helper to find areas
        $findAreas = function($list, $allSkills) {
            $found = [];
            if (empty($allSkills['personalDevelopmentSkills'])) return $found;
            foreach ($list as $item) {
                foreach ($allSkills['personalDevelopmentSkills'] as $skill) {
                    // Case-insensitive check if skill title contains the item or vice versa
                    if (str_contains(strtolower($skill['title']), strtolower($item)) || str_contains(strtolower($item), strtolower($skill['title']))) {
                        $found[] = $skill;
                        break; 
                    }
                }
            }
            return $found;
        };

        // Helper to find strengths
        $findStrengths = function($list, $allSkills) {
            $found = [];
            if (empty($allSkills['report_interpretations'])) return $found;
            foreach ($list as $item) {
                foreach ($allSkills['report_interpretations'] as $skill) {
                    // Case-insensitive check if skill title contains the item or vice versa
                    if (str_contains(strtolower($skill['skill_name']), strtolower($item)) || str_contains(strtolower($item), strtolower($skill['skill_name']))) {
                        $skill['title'] = $skill['skill_name'];
                        $skill['forStudents'] = ['definition' => $skill['student']];
                        $skill['forProfessionals'] = ['definition' => $skill['professional']];
                        $found[] = $skill;
                        break; 
                    }
                }
            }
            return $found;
        };

        $detailed_strengths = $findStrengths($strengthsList, $strengthsData);
        $detailed_areas = $findAreas($areasList, $areasData);

        // Pass to View
        $data['detailed_strengths'] = $detailed_strengths;
        $data['detailed_areas'] = $detailed_areas;
        $data['profile_key'] = $profileKey;
        $data['sub_section_traits'] = $subSectionTraits;

        // Generate pie chart images
        $data['chart_images'] = $this->buildChartImages($data['subsection_analysis']);

        // Generate PDF and cache the output for 24 hours
        $pdf = $this->pdfGenerator->generate('pdf.psychometric-report', $data, 'udyantra-psychometric-report.pdf', false);
        $pdfContent = $pdf->output();
        Cache::put($cacheKey, $pdfContent, now()->addHours(24));

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="udyantra-psychometric-report.pdf"',
        ]);
    }


}
