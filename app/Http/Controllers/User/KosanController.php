<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kosan;

class KosanController extends Controller
{
    public function index()
    {
        $kosans = Kosan::where('status', 'aktif')
            ->where('kamar_tersedia', '>', 0)
            ->with(['fotoUtama', 'ulasans'])
            ->latest()->paginate(12);
        return view('user.home', compact('kosans'));
    }

    public function search(Request $request)
    {
        $kosans = Kosan::where('status', 'aktif')
            ->where('kamar_tersedia', '>', 0)
            ->when($request->kota, fn($q) => $q->where('kota', 'like', "%{$request->kota}%"))
            ->when($request->tipe, fn($q) => $q->where('tipe', $request->tipe))
            ->when($request->harga_max, fn($q) => $q->where('harga_per_bulan', '<=', $request->harga_max))
            ->when($request->fasilitas, fn($q) => $q->where(function($query) use ($request) {
                foreach ($request->fasilitas as $f) {
                    $query->whereJsonContains('fasilitas', $f);
                }
            }))
            ->with('fotoUtama')
            ->paginate(12);
        return view('user.search', compact('kosans'));
    }
}
