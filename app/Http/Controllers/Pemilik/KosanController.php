<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use App\Models\Kosan;
use App\Models\FotoKosan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class KosanController extends Controller
{
    public function dashboard()
    {
        $kosanIds = Kosan::where('user_id', Auth::id())->pluck('id');

        $totalKosan          = $kosanIds->count();
        $totalKamarTersedia  = Kosan::whereIn('id', $kosanIds)->sum('kamar_tersedia');
        $totalPemesanan      = \App\Models\Pemesanan::whereIn('kosan_id', $kosanIds)->count();
        $pemesananPending    = \App\Models\Pemesanan::whereIn('kosan_id', $kosanIds)->where('status', 'pending')->count();
        $kosanTerbaru        = Kosan::where('user_id', Auth::id())->with('fotoUtama')->latest()->take(8)->get();

        return view('pemilik.dashboard', compact(
            'totalKosan', 'totalKamarTersedia', 'totalPemesanan', 'pemesananPending', 'kosanTerbaru'
        ));
    }

    public function index()
    {
        $kosans = Kosan::where('user_id', Auth::id())->with('fotoUtama')->get();
        return view('pemilik.kosan.index', compact('kosans'));
    }

    public function create()
    {
        return view('pemilik.kosan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kosan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'harga_per_bulan' => 'required|numeric',
            'jumlah_kamar' => 'required|integer',
            'kamar_tersedia' => 'required|integer',
            'tipe' => 'required|in:putra,putri,campur',
            'fasilitas' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $kosan = Kosan::create([
            'user_id' => Auth::id(),
            'nama_kosan' => $request->nama_kosan,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'harga_per_bulan' => $request->harga_per_bulan,
            'jumlah_kamar' => $request->jumlah_kamar,
            'kamar_tersedia' => $request->kamar_tersedia,
            'tipe' => $request->tipe,
            'fasilitas' => $request->fasilitas ?? [],
            'status' => 'aktif'
        ]);

        if ($request->hasFile('fotos')) {
            $is_utama = true;
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('foto_kosan', 'public');
                FotoKosan::create([
                    'kosan_id' => $kosan->id,
                    'foto' => $path,
                    'is_utama' => $is_utama
                ]);
                $is_utama = false; // Only the first photo is set as utama
            }
        }

        return redirect()->route('pemilik.kosan.index')->with('success', 'Kosan berhasil ditambahkan.');
    }

    public function show(Kosan $kosan)
    {
        if ($kosan->user_id !== Auth::id()) abort(403);
        $kosan->load('fotos');
        return view('pemilik.kosan.show', compact('kosan'));
    }

    public function edit(Kosan $kosan)
    {
        if ($kosan->user_id !== Auth::id()) abort(403);
        return view('pemilik.kosan.edit', compact('kosan'));
    }

    public function update(Request $request, Kosan $kosan)
    {
        if ($kosan->user_id !== Auth::id()) abort(403);

        $request->validate([
            'nama_kosan' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'alamat' => 'required|string',
            'kota' => 'required|string',
            'harga_per_bulan' => 'required|numeric',
            'jumlah_kamar' => 'required|integer',
            'kamar_tersedia' => 'required|integer',
            'tipe' => 'required|in:putra,putri,campur',
            'fasilitas' => 'nullable|array',
            'fotos.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $kosan->update([
            'nama_kosan' => $request->nama_kosan,
            'deskripsi' => $request->deskripsi,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'harga_per_bulan' => $request->harga_per_bulan,
            'jumlah_kamar' => $request->jumlah_kamar,
            'kamar_tersedia' => $request->kamar_tersedia,
            'tipe' => $request->tipe,
            'fasilitas' => $request->fasilitas ?? [],
        ]);

        if ($request->hasFile('fotos')) {
            $is_utama = $kosan->fotos()->count() === 0;
            foreach ($request->file('fotos') as $foto) {
                $path = $foto->store('foto_kosan', 'public');
                FotoKosan::create([
                    'kosan_id' => $kosan->id,
                    'foto' => $path,
                    'is_utama' => $is_utama
                ]);
                $is_utama = false;
            }
        }

        return redirect()->route('pemilik.kosan.index')->with('success', 'Kosan berhasil diupdate.');
    }

    public function destroy(Kosan $kosan)
    {
        if ($kosan->user_id !== Auth::id()) abort(403);
        
        foreach ($kosan->fotos as $foto) {
            Storage::disk('public')->delete($foto->foto);
        }
        $kosan->delete();

        return redirect()->route('pemilik.kosan.index')->with('success', 'Kosan berhasil dihapus.');
    }
}
