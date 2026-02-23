<?php

namespace App\Services;

use Barryvdh\DomPDF\Facade\Pdf;

class PdfGenerator
{
    /**
     * Generate a PDF from a view.
     *
     * @param string $view The view to load.
     * @param array $data The data to pass to the view.
     * @param string $fileName The name of the file if streaming/downloading.
     * @param bool $stream Whether to stream the PDF (true) or return the object (false).
     * @return \Illuminate\Http\Response|\Barryvdh\DomPDF\PDF
     */
    public function generate(string $view, array $data, string $fileName = 'document.pdf', bool $stream = true)
    {
        $pdf = Pdf::loadView($view, $data)
            ->setPaper('a4', 'portrait')
            ->setOption('isHtml5ParserEnabled', true)
            ->setOption('isRemoteEnabled', true);

        if ($stream) {
            return $pdf->stream($fileName);
        }

        return $pdf;
    }
}
