<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KosanApiController extends Controller
{
    // GET /api/kosan
    public function index()
    {
        $kosans = Kosan::with('fotoUtama')->get();

        return response()->json([
            'message' => 'Daftar kosan berhasil diambil',
            'data' => $kosans
        ], 200);
    }

    // GET /api/kosan/{id}
    public function show($id)
    {
        $kosan = Kosan::with(['fotoUtama', 'fotos', 'ulasans'])
            ->find($id);

        if (!$kosan) {
            return response()->json([
                'message' => 'Kosan tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'message' => 'Detail kosan',
            'data' => $kosan
        ], 200);
    }

    // POST /api/kosan
    public function store(Request $request)
    {
        // Hanya pemilik
        if (Auth::user()->role !== 'pemilik') {
            return response()->json([
                'message' => 'Hanya pemilik yang dapat menambah kosan'
            ], 403);
        }

        $validated = $request->validate([
            'nama_kosan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'harga_per_bulan' => 'required|numeric',
            'jumlah_kamar' => 'required|integer',
            'kamar_tersedia' => 'required|integer',
            'tipe' => 'required|in:putra,putri,campur',
            'fasilitas' => 'nullable|array',
        ]);

        $validated['user_id'] = Auth::id();
        $validated['status'] = 'aktif';

        $kosan = Kosan::create($validated);

        return response()->json([
            'message' => 'Kosan berhasil ditambahkan',
            'data' => $kosan
        ], 201);
    }

    // PUT /api/kosan/{id}
    public function update(Request $request, $id)
    {
        $kosan = Kosan::find($id);

        if (!$kosan) {
            return response()->json([
                'message' => 'Kosan tidak ditemukan'
            ], 404);
        }

        // Hanya pemilik kosan
        if ($kosan->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Tidak memiliki akses'
            ], 403);
        }

        $validated = $request->validate([
            'nama_kosan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'harga_per_bulan' => 'required|numeric',
            'jumlah_kamar' => 'required|integer',
            'kamar_tersedia' => 'required|integer',
            'tipe' => 'required|in:putra,putri,campur',
            'fasilitas' => 'nullable|array',
        ]);

        $kosan->update($validated);

        return response()->json([
            'message' => 'Kosan berhasil diupdate',
            'data' => $kosan
        ], 200);
    }

    // DELETE /api/kosan/{id}
    public function destroy($id)
    {
        $kosan = Kosan::find($id);

        if (!$kosan) {
            return response()->json([
                'message' => 'Kosan tidak ditemukan'
            ], 404);
        }

        // Hanya pemilik kosan
        if ($kosan->user_id !== Auth::id()) {
            return response()->json([
                'message' => 'Tidak memiliki akses'
            ], 403);
        }

        $kosan->delete();

        return response()->json([
            'message' => 'Kosan berhasil dihapus'
        ], 200);
    }
}