<?php

namespace App\Http\Controllers;

use App\Models\KomoditasData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class DataHarianPdfController extends Controller
{
    public function cetakPdf(Request $request)
    {
        $tanggal = $request->tanggal;

        $data = KomoditasData::with(['user', 'responden', 'komoditas'])
            ->whereDate('tanggal', $tanggal)
            ->get();

        $pdf = Pdf::loadView('pdf.data-harian', compact('data', 'tanggal'));

        return $pdf->stream("data-harian-{$tanggal}.pdf");
    }
}