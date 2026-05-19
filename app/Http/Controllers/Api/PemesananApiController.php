<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use App\Models\Pemesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PemesananApiController extends Controller
{
    // Lihat semua pemesanan user login
    public function index()
    {
        $pemesanans = Pemesanan::where('user_id', Auth::id())
            ->with('kosan')
            ->latest()
            ->get();

        return response()->json($pemesanans);
    }

    // Buat pemesanan
    public function store(Request $request)
    {
        $request->validate([
            'kosan_id' => 'required|exists:kosans,id',
            'tanggal_masuk' => 'required|date',
            'durasi_bulan' => 'required|integer|min:1|max:24',
            'catatan' => 'nullable|string|max:500',
        ]);

        $kosan = Kosan::findOrFail($request->kosan_id);

        if ($kosan->kamar_tersedia <= 0) {
            return response()->json([
                'message' => 'Kamar sudah penuh'
            ], 400);
        }

        $totalHarga = $kosan->harga_per_bulan * $request->durasi_bulan;

        $pemesanan = Pemesanan::create([
            'user_id' => Auth::id(),
            'kosan_id' => $kosan->id,
            'tanggal_masuk' => $request->tanggal_masuk,
            'durasi_bulan' => $request->durasi_bulan,
            'total_harga' => $totalHarga,
            'status' => 'pending',
            'catatan' => $request->catatan,
        ]);

        return response()->json([
            'message' => 'Pemesanan berhasil dibuat',
            'data' => $pemesanan
        ], 201);
    }

    // Detail pemesanan
    public function show($id)
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())
            ->findOrFail($id);

        return response()->json($pemesanan);
    }

    // Batalkan pemesanan
    public function destroy($id)
    {
        $pemesanan = Pemesanan::where('user_id', Auth::id())
            ->findOrFail($id);

        if ($pemesanan->status !== 'pending') {
            return response()->json([
                'message' => 'Hanya pending yang bisa dibatalkan'
            ], 400);
        }

        $pemesanan->update([
            'status' => 'dibatalkan'
        ]);

        return response()->json([
            'message' => 'Pemesanan berhasil dibatalkan'
        ]);
    }
}