<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PdfGenerator;
use CpChart\Data;
use CpChart\Image;
use CpChart\Chart\Pie;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class AdminReportController extends Controller
{
    protected $pdfGenerator;

    public function __construct(PdfGenerator $pdfGenerator)
    {
        $this->pdfGenerator = $pdfGenerator;
    }

    /**
     * Generate PDF report for admin panel.
     * This route is protected by VerifyAdminSignature middleware (no session needed).
     * It calls the admin backend API directly using a shared admin token.
     */
    public function generateReport($userId, $testResultId)
    {
        $cacheKey = "pdf_report_{$userId}_{$testResultId}";

        $pdfContent = Cache::remember($cacheKey, 86400, function () use ($userId, $testResultId) {
            //24 hours=86400sec cache
            
            // 1. Fetch data from admin backend API
            $data = $this->fetchReportData($userId, $testResultId);

            if (!$data || ($data['status'] ?? '') !== 'success') {
                abort(500, 'Failed to fetch report data from the backend API.');
            }

            // 2. Load JSON files for detailed analysis
            $areasJsonPath = public_path('assets/pdf-report/area-of-improvement.json');
            $areasData = [];
            if (file_exists($areasJsonPath)) {
                $areasData = json_decode(file_get_contents($areasJsonPath), true);
            }

            $strengthsJsonPath = public_path('assets/pdf-report/strength.json');
            $strengthsData = [];
            if (file_exists($strengthsJsonPath)) {
                $strengthsData = json_decode(file_get_contents($strengthsJsonPath), true);
            }

            $subSectionJsonPath = public_path('assets/pdf-report/sub-section.json');
            $subSectionTraits = [];
            if (file_exists($subSectionJsonPath)) {
                $subSectionData = json_decode(file_get_contents($subSectionJsonPath), true);
                $subSectionTraits = $subSectionData['traits'] ?? [];
            }

            // 3. Determine profile type (Student vs Professional)
            $isStudent = false;
            if (str_contains($data['test_name'], 'SENIOR') || str_contains($data['test_name'], 'JUNIOR')) {
                $isStudent = true;
            }
            $profileKey = $isStudent ? 'forStudents' : 'forProfessionals';

            // 4. Extract strengths and areas from primary outcome
            $outcome = $data['outcomes'][0] ?? [];
            $strengthsList = array_filter(array_map('trim', preg_split('/[,;]|\band\b/i', $outcome['strengths'] ?? '')));
            $areasList = array_map('trim', explode(';', $outcome['areas_to_improve'] ?? ''));

            // Helper: find matching areas from JSON
            $findAreas = function($list, $allSkills) {
                $found = [];
                if (empty($allSkills['personalDevelopmentSkills'])) return $found;
                foreach ($list as $item) {
                    foreach ($allSkills['personalDevelopmentSkills'] as $skill) {
                        if (str_contains(strtolower($skill['title']), strtolower($item)) || str_contains(strtolower($item), strtolower($skill['title']))) {
                            $found[] = $skill;
                            break;
                        }
                    }
                }
                return $found;
            };

            // Helper: find matching strengths from JSON
            $findStrengths = function($list, $allSkills) {
                $found = [];
                if (empty($allSkills['report_interpretations'])) return $found;
                foreach ($list as $item) {
                    foreach ($allSkills['report_interpretations'] as $skill) {
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

            // 5. Load brand logo as base64
            $brandLogoBase64 = '';
            $brandLogoUrl = $data['brand_logo'] ?? null;
            if ($brandLogoUrl) {
                $storagePath = env('UDYANTRA_STORAGE_PATH', public_path('udyantra-storage'));
                $brandLogoPath = $storagePath . '/' . $brandLogoUrl;
                if (file_exists($brandLogoPath)) {
                    $type = pathinfo($brandLogoPath, PATHINFO_EXTENSION);
                    $brandLogoData = file_get_contents($brandLogoPath);
                    $brandLogoBase64 = 'data:image/' . $type . ';base64,' . base64_encode($brandLogoData);
                }
            }

            // 6. Build view data
            $data['detailed_strengths'] = $detailed_strengths;
            $data['detailed_areas'] = $detailed_areas;
            $data['profile_key'] = $profileKey;
            $data['sub_section_traits'] = $subSectionTraits;
            $data['brand_logo_base64'] = $brandLogoBase64;

            // 7. Generate pie chart images
            $data['chart_images'] = $this->buildChartImages($data['subsection_analysis'] ?? []);

            // 8. Generate PDF
            $pdf = $this->pdfGenerator->generate('pdf.psychometric-report', $data, 'udyantra-psychometric-report.pdf', false);
            return $pdf->output();
        });

        return response($pdfContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="udyantra-psychometric-report.pdf"',
        ]);
    }

    /**
     * Fetch report data from the admin backend API.
     * Uses the shared admin report token for authentication.
     */
    private function fetchReportData($userId, $testResultId)
    {
        $baseUrl = config('services.backend.url');
        $adminToken = config('services.admin_report.api_token');

        $response = Http::withToken($adminToken)
            ->acceptJson()
            ->get("{$baseUrl}/career-analysis", [
                'user_id' => $userId,
                'test_result_id' => $testResultId,
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
        $labelWithPct = [];
        foreach ($labels as $i => $label) {
            $labelWithPct[] = '  ' . $label . ' (' . $values[$i] . '%)  ';
        }

        $data = new Data();
        $data->addPoints($values, 'Values');
        $data->addPoints($labelWithPct, 'Labels');
        $data->setAbscissa('Labels');

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

        $image = new Image(1200, 750, $data);
        $fontPath = base_path('vendor/szymach/c-pchart/resources/fonts/verdana.ttf');
        $image->setFontProperties(['FontName' => $fontPath, 'FontSize' => 17]);

        foreach ($palette as $idx => $color) {
            $image->drawRectangle(0, 0, 0, 0, [
                'R' => 255, 'G' => 255, 'B' => 255, 'Alpha' => 0
            ]);
        }

        $pie = new Pie($image, $data);

        foreach ($palette as $idx => $color) {
            $pie->setSliceColor($idx, $color);
        }

        $pie->draw2DPie(600, 325, [
            'Radius' => 250,
            'StartAngle' => 120,
            'Border' => true,
            'BorderR' => 255, 'BorderG' => 255, 'BorderB' => 255,
            'DrawLabels' => true,
        ]);

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
}
