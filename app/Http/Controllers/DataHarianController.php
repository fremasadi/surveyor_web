<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataHarian; // Import model DataHarian
use Illuminate\Support\Facades\Auth;

class DataHarianController extends Controller
{
    // Fungsi untuk mendapatkan data harian
    public function getDataHarian(Request $request)
{
    $user = Auth::user();

    // Ambil query parameter
    $tanggal = $request->query('tanggal'); // Format: YYYY-MM-DD
    $bulan = $request->query('bulan');     // Format: 1-12
    $tahun = $request->query('tahun');     // Format: YYYY

    $dataHarianQuery = DataHarian::where('user_id', $user->id)
        ->with(['komoditas', 'responden']);

    // Filter berdasarkan tanggal jika ada
    if ($tanggal) {
        $dataHarianQuery->whereDate('tanggal', $tanggal);
    }

    // Filter berdasarkan bulan jika ada
    if ($bulan) {
        $dataHarianQuery->whereMonth('tanggal', $bulan);
    }

    // Filter berdasarkan tahun jika ada
    if ($tahun) {
        $dataHarianQuery->whereYear('tanggal', $tahun);
    }

    $dataHarian = $dataHarianQuery->get();

    $dataHarian = $dataHarian->map(function ($item) {
        return [
            'id' => $item->id,
            'user_id' => $item->user_id,
            'komoditas_id' => $item->komoditas_id,
            'komoditas_name' => $item->komoditas->name ?? null,
            'responden_id' => $item->responden_id,
            'responden_name' => $item->responden->name ?? null,
            'tanggal' => $item->tanggal,
            'status' => $item->status,
            'data_input' => $item->data_input,
            'created_at' => $item->created_at,
            'updated_at' => $item->updated_at,
        ];
    });

    return response()->json([
        'message' => 'Data Berhasil Diambil',
        'data' => $dataHarian
    ]);
}


    // Fungsi untuk menambah data harian
    public function addDataHarian(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'komoditas_id' => 'required|exists:komoditas,id',
            'responden_id' => 'required|exists:respondens,id',
            'tanggal' => 'required|date',
            'data_input' => 'required|string|max:255',
        ]);

        // Dapatkan user ID yang sedang login
        $userId = Auth::id();

        // Tambahkan data ke tabel data_harian
        $dataHarian = DataHarian::create([
            'user_id' => $userId,
            'komoditas_id' => $validatedData['komoditas_id'],
            'responden_id' => $validatedData['responden_id'],
            'tanggal' => $validatedData['tanggal'],
            'data_input' => $validatedData['data_input'],
            'status' => 0, // Default status saat data ditambahkan
        ]);

        return response()->json([
            'message' => 'Data berhasil ditambahkan',
            'data' => $dataHarian
        ]);
    }

    // Fungsi untuk mengedit data harian
    public function editDataHarian(Request $request, $id)
    {
        // Cari data_harian berdasarkan ID
        $dataHarian = DataHarian::find($id);

        // Periksa apakah data ditemukan
        if (!$dataHarian) {
            return response()->json([
                'message' => 'Data not found'
            ], 404);
        }

        // Periksa apakah status masih false
        if ($dataHarian->status) {
            return response()->json([
                'message' => 'Data tidak bisa diedit karena admin sudah acc'
            ], 403);
        }

        // Validasi input
        $validatedData = $request->validate([
            'komoditas_id' => 'required|exists:komoditas,id',
            'responden_id' => 'required|exists:respondens,id',
            'tanggal' => 'required|date',
            'data_input' => 'required|string|max:255',
        ]);

        // Update data
        $dataHarian->update([
            'komoditas_id' => $validatedData['komoditas_id'],
            'responden_id' => $validatedData['responden_id'],
            'tanggal' => $validatedData['tanggal'],
            'data_input' => $validatedData['data_input'],
        ]);

        return response()->json([
            'message' => 'Data berhasil diupdate',
            'data' => $dataHarian
        ]);
    }
}
