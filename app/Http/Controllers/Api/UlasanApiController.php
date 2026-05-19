<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use App\Models\Ulasan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UlasanApiController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string|max:500',
        ]);

        $kosan = Kosan::findOrFail($id);

        // cek apakah user pernah pesan kos ini
        $sudahPesan = Auth::user()
            ->pemesanans()
            ->where('kosan_id', $id)
            ->where('status', 'disetujui')
            ->exists();

        if (!$sudahPesan) {
            return response()->json([
                'message' => 'Anda belum pernah menyewa kos ini'
            ], 403);
        }

        // cek sudah review atau belum
        $sudahReview = Ulasan::where('user_id', Auth::id())
            ->where('kosan_id', $id)
            ->exists();

        if ($sudahReview) {
            return response()->json([
                'message' => 'Anda sudah memberikan ulasan'
            ], 400);
        }

        $ulasan = Ulasan::create([
            'user_id' => Auth::id(),
            'kosan_id' => $id,
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        return response()->json([
            'message' => 'Ulasan berhasil ditambahkan',
            'data' => $ulasan
        ], 201);
    }
}