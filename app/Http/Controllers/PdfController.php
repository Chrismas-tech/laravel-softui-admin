<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\PDF;

class PdfController extends Controller
{
    public function pdfDownload()
    {
        $pdf = PDF::loadView('pdf.pdf');
        return $pdf->download('pdf.pdf');
    }
}
