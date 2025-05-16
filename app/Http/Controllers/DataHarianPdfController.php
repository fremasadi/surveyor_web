<?php

namespace App\Http\Controllers;

use App\Models\KomoditasData;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Facades\Log;

class DataHarianPdfController extends Controller
{
    public function cetakPdf(Request $request)
    {
        try {
            $tanggal = $request->tanggal;

            // Validasi format tanggal
            if (!$tanggal) {
                return response()->json(['error' => 'Tanggal tidak boleh kosong'], 400);
            }

            // Mengambil data dengan eager loading
            $data = KomoditasData::with(['user', 'responden', 'komoditas'])
                ->whereDate('tanggal', $tanggal)
                ->get();

            // Log jumlah data yang diambil untuk debugging
            Log::info("Mencetak PDF untuk tanggal: $tanggal, jumlah data: " . $data->count());

            // Menambahkan debug info ke view
            $debug = [
                'tanggal' => $tanggal,
                'jumlah_data' => $data->count(),
            ];

            // Konfigurasi tambahan untuk DomPDF
            $options = [
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true,
                'isRemoteEnabled' => true,
                'defaultFont' => 'sans-serif',
                'dpi' => 150
            ];

            $pdf = Pdf::loadView('pdf.data-harian', compact('data', 'tanggal', 'debug'))
                ->setOptions($options);

            return $pdf->stream("data-harian-{$tanggal}.pdf");

        } catch (Exception $e) {
            // Log error untuk debugging
            Log::error('Error saat generate PDF: ' . $e->getMessage());

            // Return error page yang informatif
            return response()->view('errors.pdf-error', [
                'message' => $e->getMessage(),
                'tanggal' => $request->tanggal ?? 'tidak ada'
            ], 500);
        }
    }
}