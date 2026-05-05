<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::whereHas('kosan', function ($q) {
                $q->where('user_id', auth()->id());
            })
            ->with(['user', 'kosan'])
            ->latest()
            ->paginate(10);

        return view('pemilik.pemesanan.index', compact('pemesanans'));
    }

    public function show(Pemesanan $pemesanan)
    {
        return view('pemilik.pemesanan.show', compact('pemesanan'));
    }

    public function setujui(Pemesanan $pemesanan)
    {
        $pemesanan->update(['status' => 'disetujui']);
        return back()->with('success', 'Pemesanan disetujui.');
    }

    public function tolak(Pemesanan $pemesanan)
    {
        $pemesanan->update(['status' => 'ditolak']);
        return back()->with('success', 'Pemesanan ditolak.');
    }
}
